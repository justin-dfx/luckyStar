<?php
/*
* 数据采集类
*/
ini_set('max_execution_time',30*60*60*60);			//设置程序最大运行时间、默认为60秒
class Gather{
//----------------单例模式------------------------------------------
    private static $instance;				//保存类实例在此属性中
	// 构造方法声明为private，防止直接创建对象
	private function __construct(){
	}
    // singleton 方法
    public static function singleton(){
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }
    // 阻止用户复制对象实例
    public function __clone(){
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
//----------------------------------------------------------------
	public function init($config){//必须要初始化dtime参数，不然会造成多次下载图片！
		$this-> _cache = '.cache/';		//缓存文件所在路径
		$this-> name = 'defect';	//*当前采集的网站名称(一般填写网站的域名)
		$this-> url	= '';			//待抓取的链接
		$this-> html	= '';			//抓取到的html
		$this-> dtime  = time();		//*采集时间戳 
		foreach($config as $key => $val){
			$this->$key = $val;
		}
		$this -> _cache	= $this->_cache .$this->name.'/';
		$this-> _images_dir = 'data/images/'.$this->name.'/';//. date("YmdH",$this->dtime).'/';			//*图片存储目录
		if($this->aid){//如果初始化了存储id，者分目录存储缓存html和图片文件
			$a = floor($this->aid/300/300);//取整
			$b = floor($this->aid/300)%300;//fmod($f);//取余
			$this->_images_dir .= $a.'/'.$b.'/';		
			$this -> _cache    .= $a.'/'.$b.'/';
		}else{//没有传id时的存储目录
			$this -> _cache    .= 'list_html/';
		}

	}
	/*
	*	更具url获取html文本
	*/
	public function get_page_html($url,$is_cache = true){
		if($is_cache){//如果需要缓存
			$file_name = $this -> _cache . md5($url).".html";//获取缓存文件名（包括路径）
			if(file_exists($file_name)){
				$this -> html = file_get_contents($file_name);
			}else{
				$this -> html= $this -> crawl($url);
				$this	->	makeDirs($this -> _cache);							//建立缓存目录
				file_put_contents($file_name,$this -> html);
			}
		}else{
			$this -> html= $this -> crawl($url);
		}
		$encode = mb_detect_encoding($this -> html,array('GB2312','GBK','UTF-8','ASCII'));
		if($encode != "UTF-8"){$this -> html = iconv($encode,"utf-8",$this -> html);}
		return $this -> html;
	}
	/*
	*	更具url删除缓存文件 删除成功
	*/
	public function deleteCacheByUrl($url){
		$file_name = $this -> _cache . md5($url).".html";//获取缓存文件名（包括路径）
		if(file_exists($file_name)){
			if(unlink($file_name)){
				return $file_name;
			}else{
				$this->errLog("删除文件失败：$file_name");
				return FALSE;
			}
		}else{
			$this->errLog("删除失败：$file_name不存在！");
			return FALSE;
		}
	}
	// 删除回车换行,多个空格转换为单个空格
	public function noReturn($value) {
		$this->html = str_replace("\n", "", empty($value)?$this->html:$value);
		$this->html = str_replace("\r", "", $this->html);
		$this->html= str_replace("/\s+/", " ", $this->html);
		return $this->html;
	}
	/*
	*	抓取函数
	*/
	private function crawl($url){
		if(function_exists("curl_init")){//采用cUrl抓取
			// 初始化一个 cURL 对象
			$curl = curl_init();
			// 设置你需要抓取的URL
			curl_setopt($curl, CURLOPT_URL, $url);
			// 设置header
			curl_setopt($curl, CURLOPT_HEADER, 0);
			// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			// 运行cURL，请求网页
			$data = curl_exec($curl);
			$code = curl_getinfo($curl, CURLINFO_HTTP_CODE); //获取返回状态
			if ($code != 200) {
					//@unlink($filename);
					//throw new Exception('无法获得远程商品原图:'.$url." 到:".$filename);
				$this->errLog('抓取html数据失败url=:'.$url,'error');
			}
			// 关闭URL请求
			curl_close($curl);
		}else{
			$data = file_get_contents($url);
			if(!empty($data )){
				return $data;
			}
			//使用socket抓取数据
			$aurl = parse_url($url);
			
			/* Get the port for the WWW service. */
			$service_port = getservbyname('www', 'tcp');
	
			/* Get the IP address for the target host. */
			$address = gethostbyname($aurl['host']);
	
			/* Create a TCP/IP socket. */
			$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			if ($socket < 0) {
				$this -> errLog("socket_create() failed: reason: " . socket_strerror($socket) );
				return false;
			}
			
			// echo "Attempting to connect to '$address' on port '$service_port'...";
			$result = socket_connect($socket, $address, $service_port);
			if ($result < 0) {
				$this -> errLog("socket_connect() failed.\nReason: ($result) " . socket_strerror($result));
				return false;
			}
			$out = '';
	
			$cmd = "GET ".substr(strstr($url, $aurl['host']), strlen($aurl['host']))." HTTP/1.0\n";
			$cmd .= "User-Agent: My Name is bud\n";
			$cmd .= "Accept: */*\n";
			$cmd .= "Host: ".$aurl['host']."\n";
			$cmd .= "Connection: Keep-Alive\n\n";
			
			socket_write($socket, $cmd, strlen($cmd));
	
			while ($out = socket_read($socket, 2048)) {
				$data .= $out;
			}
	
			socket_close($socket);
		}
		return $data;
	}

	//自动建立目录
	private function makeDirs($dirs='',$mode='0777'){
		$dirs=str_replace('\\','/',trim($dirs));
		if (!empty($dirs) && !file_exists($dirs)){
			$this -> makeDirs(dirname($dirs));//回调
			mkdir($dirs,$mode) or $this -> errLog('建立目录'.$dirs.'失败,请尝试手动建立!');
		}
	}
	//'按指定首尾字符串对收集的内容进行裁减（不包括首尾字符串）方法
	// $no 必须是 1,2 3 ... 不允许是0
	//$comprise 可以选择 start 或者 end 或者 all 或者 什么都不填
	public function cut($start, $end, $no = '1', $comprise = '') {
		$string = explode($start, $this->html);
		$string = explode($end, $string[$no]);
		switch ($comprise) {
			case 'start' :
				$string = $start . $string[0];
				break;
			case 'end' :
				$string = $string[0] . $end;
				break;
			case 'all' :
				$string = $start . $string[0] . $end;
				break;
			default :
				$string = $string[0];
		}
		return $string;
	}
	/*
	* 保存图片
	* 使用Curl抓取图片，服务器必须开启Curl扩展
	*/
	public function gather_image($url,$filename="") {
	//	set_time_limit(24 * 60 * 60 * 60);//php set_time_limit函数的功能是设置当前页面执行多长时间不过期哦。
		if($url==""):return false;endif;
		$url = preg_replace('/ /','%20',$url);
		//$url = urlencode($url);//编码 URL 字符串,curl不能识别空格等特殊字符
		if($filename == "" ){//如果未指定图片名字（包括图片存储路径）
			$ext=strrchr($url,".");
			if($ext!=".gif" && $ext!=".jpg"):return false;endif;//如果不是gif或者jpg图片，返回失败
			$filename = $this->_images_dir.date("Y-m-d_H_i",$this->dtime).'_'.md5($url).$ext;//为图片命名
		}
		if(file_exists($filename) ): $this->errLog('文件已经存在：'.$filename);return $filename;endif;
		$this -> makeDirs(dirname($filename));//创建目录
		if (file_exists(dirname($filename)) && is_readable(dirname($filename)) && is_writable(dirname($filename))) {
			try {
				$ch = curl_init($url);
				$fp = @fopen($filename, 'w');
				curl_setopt($ch, CURLOPT_FILE, $fp);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_exec($ch);
				$code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
				curl_close($ch);
				fclose($fp);
				if ($code != 200) {
					@unlink($filename);
					throw new Exception('无法获得远程商品原图:'.$url." 到:".$filename);
				}
			} catch(Exception $e) {
				curl_close($ch);
				fclose($fp);
				$filename = false;
				$this->errLog($e->getMessage(),'error');
			}
			if(filesize($filename)<100){
				@unlink($filename);
				$this->errLog('抓取的图片太小了','error');
				return false;
			}
			return $filename;
		}else{
			$this->errLog('文件夹不存在或没有读写权限！'.dirname($filename));
		}
		return false;
	}
	/*
	* 日志输出
	*/
	public function errLog($msg,$type='debug'){
		$date = date('Y-m-d H:i:s'); 
		$log = $msg."   |  Date:  ".$date."\n"; 
		if($type == 'debug' ){
			error_log($log,3,$this->name.'/debug.txt');
		}else{
			error_log($log,3,$this->name.'/error.txt');
		}
	}
	//'对收集的内容中的符合正则表达式的字符串用新值进行替换/方法
	//'参数是你自定义的正则表达式,新值
	public function replaceByReg($patrn, $str) {
		return join("", preg_replace($patrn, $str, $this->html));
	}
}
