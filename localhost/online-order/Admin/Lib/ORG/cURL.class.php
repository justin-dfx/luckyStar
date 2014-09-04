<?php
define('CURL_USE_COOKIES',TRUE);//是否使用cookies
define('CURL_COOKIES_TEMP_FILE',TEMP_PATH.'cookies.txt');//cookies文件存储位置

class cURL {
	private $headers = array();//http头参数列表
	private $user_agent;
	private $compression;
	private $proxy;//代理
    private $use_cookies = FALSE;// 是否使用cookies
    private $cookies_file_name = '';//cookies文件存储位置
    private $code=0;//curl状态码
	#构造函数
	public function __construct($use_cookies=CURL_USE_COOKIES,$cookie_file_name=CURL_COOKIES_TEMP_FILE,$compression='gzip',$proxy=false) {
		$this->headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'; 
		$this->headers[] = 'Connection: keep-alive'; 
		$this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8'; 
		$this->headers[] = 'Accept-Language: zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3'; 
		//$this->headers[] = 'Accept-Encoding: gzip, deflate'; 
		$this->headers[] = 'Cache-Control: max-age=0'; 
		
		$this->user_agent = 'Mozilla/5.0 (Windows NT 5.1; rv:13.0) Gecko/20100101 Firefox/13.0.1';
		$this->compression=$compression; 
		$this->proxy=$proxy;
        if ($use_cookies == TRUE ){//如果使用cookies，初始化cookies临时文件
            if(!is_file($cookie_file_name) ){//如果不存在文件，创建文件
                if(!is_writable(dirname($cookie_file_name))){
                    throw new ErrorException(dirname($cookie_file_name).':文件夹不可写。');
                }else{
                    @fopen($cookie_file_name,'w');
                    @fclose($this->cookie_file);
                }
            }elseif(!is_writable($cookie_file_name)){
                throw new ErrorException($cookie_file_name.':不能被打开。确保这个目录有正确的权限');
            }
        }
        $this->use_cookies = $use_cookies;
        $this->cookies_file_name = $cookie_file_name;
    }
    /**
     * 获取数据
     * @access public
     * @param string $url 资源url地址
     * @param string $referer 来源地址（解决防盗链问题）
     * @return mixed   返回采集回来的数据
     */
	public function get($url,$referer=false) {
		$process = curl_init($url); 
		curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers); //一个用来设置HTTP头字段的数组。使用方式： array('Content-type: text/plain', 'Content-length: 100') 
		curl_setopt($process, CURLOPT_HEADER, 0); //启用时会将头文件的信息作为数据流输出:不返回header部分
		curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent); //在HTTP请求中包含一个"User-Agent: "头的字符串
		if($this->use_cookies == TRUE){
            curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookies_file_name); //设置从$cookie所指文件中读取cookie信息以发送
            curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookies_file_name); //设置将返回的cookie保存到$cookie所指文件
        }
		curl_setopt($process,CURLOPT_ENCODING , $this->compression); //HTTP请求头中"Accept-Encoding: "的值。支持的编码有"identity"，"deflate"和"gzip"。如果为空字符串""，请求头会发送所有支持的编码类型。
		curl_setopt($process, CURLOPT_TIMEOUT, 60); //设置cURL允许执行的最长秒数。
		if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy); //HTTP代理通道。 
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1); //将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。 
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1); //启用时会将服务器服务器返回的"Location: "放在header中递归的返回给服务器，使用CURLOPT_MAXREDIRS可以限定递归返回的数量。 
		if(!empty($referer)){//设置来源
			$urlinfo = parse_url($referer);
			curl_setopt($process,CURLOPT_REFERER, $urlinfo['scheme'] . '://' . $urlinfo['host']);
		}
		$return = curl_exec($process);
        $this->code = curl_getinfo($process, CURLINFO_HTTP_CODE); //获取返回状态
		curl_close($process);
		if($this->code != 200){//采集失败，返回false
			return false;
		}
		return $return; 
	}

    /**
     * 用post获取数据
     * @param $url
     * @param $data
     * @return mixed
     */
    public function post($url,$data) {
		$process = curl_init($url); 
		curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers); 
		curl_setopt($process, CURLOPT_HEADER, 1); 
		curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
        if($this->use_cookies == TRUE){
            curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookies_file_name); //设置从$cookie所指文件中读取cookie信息以发送
            curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookies_file_name); //设置将返回的cookie保存到$cookie所指文件
        }
		curl_setopt($process, CURLOPT_ENCODING , $this->compression); 
		curl_setopt($process, CURLOPT_TIMEOUT, 30); 
		if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy); 
		curl_setopt($process, CURLOPT_POSTFIELDS, $data); 
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1); 
		curl_setopt($process, CURLOPT_POST, 1); 
		$return = curl_exec($process); 
		curl_close($process); 
		return $return; 
	}
	/*public function error($error) {
		echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
		die;
	}*/
    /**
     * 下载指定url的数据到指定文件
     * @access public
     * @param string $url 资源url地址
     * @param string $local 下载到本地的地址
     * @param string $referer 来源地址（避免防盗链问题）
     * @return mixed   返回采集回来的数据
     */
	public function _download($url,$local,$referer=false){
		if(!is_dir(dirname($local))){
			$this->mk_dir(dirname($local));
            //mkdir(dirname($local),777,true);
		}elseif(is_file($local)){//如果已经下载！
			return $local;
		}
		$reg = $this->get($url,$referer);
		if($reg === false){
			return false;
		}
		if(file_put_contents($local,$reg)){
			return $local;
		}
		return false;
	}
    /**
     +----------------------------------------------------------
     * 循环创建目录
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $dir 文件夹路径
     * @param int $mode 权限
     +----------------------------------------------------------
     * @return boole
     +----------------------------------------------------------
     */
	public function mk_dir($dir, $mode = 0777) {
		if (is_dir($dir) || @mkdir($dir, $mode))
			return true;
		if (! $this->mk_dir(dirname($dir), $mode))
			return false;
		return @mkdir($dir, $mode);
	}
    /**
     * 获取下载后的状态码
     * @return int
     */
    public function getCode(){
        return $this->code;
    }
}