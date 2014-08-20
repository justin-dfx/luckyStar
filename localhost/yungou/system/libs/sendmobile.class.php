<?php 

class sendmobile {

	private $flag=0;
	private $argv=array();
	public $error='';
	public $v;
	public function __construct(){
		$this->mobile = $mobile = System::load_sys_config('mobile');
			
		if(!is_array($mobile)){
			return "ERROR:短信配置不正确!";
		}
		if($mobile['cfg_mobile_on']==1){
			$this->cfg_seting_1($mobile);
		}
		if($mobile['cfg_mobile_on']==2){
			$this->cfg_seting_2($mobile);
		}
	}
	
	//新版短信配置设置
	private function cfg_seting_1($mobile,$type=null){
		
	}
	
	//原版短信配置设置
	private function cfg_seting_2($mobile,$type=null){		
		$this->argv['sn']  =  $mobile['cfg_mobile_2']['mid'];
		$this->argv['pwd'] = strtoupper(md5($mobile['cfg_mobile_2']['mid'].$mobile['cfg_mobile_2']['mpass']));			
	}
	
	public function init($config=NULL){
		if(!is_array($config)){
				return 0;
		}
		if($config['mobile']==NULL)return false;
		if($config['content']==NULL)return false;
	
		$this->argv['mobile']=$config['mobile'];
		$this->argv['content']=$config['content'];
		$this->argv['ext']=$config['ext'];	
		$this->argv['stime']=$config['stime'];
		$this->argv['rrid']=$config['rrid'];	
		return true;
	}
	
	
	public function send(){
			if($this->mobile['cfg_mobile_on'] == 1){
				$this->send1();
			}
			if($this->mobile['cfg_mobile_on'] == 2){
				$this->send2();
			}
	}
	public function send2(){
		$params='';
		$this->argv['content'] =iconv( "UTF-8", "gb2312//IGNORE" ,$this->argv['content'].$this->mobile['cfg_mobile_2']['mqianming']);
		$argv=$this->argv;
		$flag=$this->flag;
		foreach ($argv as $key=>$value) { 			 
			 if ($flag!=0){
							 $params .= "&"; 
							 $flag = 1;
			 } 
			 $params.= $key."="; $params.= urlencode($value); 
			 $flag = 1;
		}
			 $length = strlen($params); //sdk2.zucp.net //sdk1.entinfo.cn
			 $fp = fsockopen("sdk2.zucp.net",80,$errno,$errstr,10) or exit($errstr."--->".$errno);
			 $header = "POST /webservice.asmx/mt HTTP/1.1\r\n"; 
			 $header .= "Host:sdk2.zucp.net\r\n"; 
			 $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
			 $header .= "Content-Length: ".$length."\r\n"; 
			 $header .= "Connection: Close\r\n\r\n";
			 
			 $header .= $params."\r\n"; 
			 
			 fputs($fp,$header); 
			 $inheader = 1; 
			
			 while (!feof($fp)) { 
                         $line = fgets($fp,1024);
                         if ($inheader && ($line == "\n" || $line == "\r\n")) { 
                                 $inheader = 0; 
                          } 
                          if ($inheader == 0) { 
                                // echo $line; 
                          } 
			 } 
			
			 $line=str_replace("<string xmlns=\"http://tempuri.org/\">","",$line);
	         $line=str_replace("</string>","",$line);
		     $result=explode("-",$line);
			 
			if(count($result)>1){
				//发送失败
				$this->v=$line;
				$this->error=-1;
			}else{
				//发送成功
				$this->v=$line;
				$this->error=1;
			}				
	}
	
	public function GetBalance(){	
		$flag = 0; 
		$mobile = $this->mobile['cfg_mobile_2'];	
		if($mobile['mid']==null || $mobile['mpass']==null){
			$this->error=-2;
			$this->v="短信账户或者密码不能为空!";
			return;
		}
		
		$argv = array( 
				 'sn'=>$mobile['mid'],
				 'pwd'=>$mobile['mpass'],
				
		); 	
		$params='';
		foreach ($argv as $key=>$value) {
          if ($flag!=0) { 
                         $params .= "&"; 
                         $flag = 1; 
          } 
         $params.= $key."="; $params.= urlencode($value); 
         $flag = 1; 
        } 
        $length = strlen($params); 
	 
        $fp = fsockopen("sdk2.zucp.net",8060,$errno,$errstr,10) or exit($errstr."--->".$errno); 
        $header = "POST /webservice.asmx/GetBalance HTTP/1.1\r\n"; 
        $header .= "Host:sdk2.zucp.net:8060\r\n"; 
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
        $header .= "Content-Length: ".$length."\r\n"; 
        $header .= "Connection: Close\r\n\r\n";
        $header .= $params."\r\n";         
        fputs($fp,$header); 
        $inheader = 1; 
        while (!feof($fp)) { 
			$line = fgets($fp,1024);
            if ($inheader && ($line == "\n" || $line == "\r\n")) { 
                    $inheader = 0; 
            } 
            if ($inheader == 0) { 
              // echo $line; 
            } 
        } 
		  
	     $line=str_replace("<string xmlns=\"http://tempuri.org/\">","",$line);
	     $line=str_replace("</string>","",$line);
		 $result=explode("-",$line);
		 if(count($result)>1){
				$this->v=$line;
				$this->error=-1;
		 }else{
				$this->v=$line;
				$this->error=1;
		 }		
	}

	
	//新版短信发送
	public function send1(){
		$mobile = $this->mobile['cfg_mobile_1'];
		$name = urlencode($mobile['mid']);
		$pwd  = $mobile['mpass'];
		$haoma = $this->argv['mobile'];
		
		$content = iconv( "UTF-8", "gb2312//IGNORE" ,$this->argv['content']);
		$content = urlencode($content);			
		
	
		$fp=fopen("http://203.81.21.34/send/gsend.asp?name=$name&pwd=$pwd&dst=$haoma&msg=$content","r");		
		if(!$fp){
			$fp=fopen("http://203.81.21.13/send/gsend.asp?name=$name&pwd=$pwd&dst=$haoma&msg=$content","r");
		}
		if(!$fp){
			fclose($fp);
			$this->error=-1;
			$this->v = "打开文件发送失败";
			return;
		}	
		$ret = '';
		while (!feof($fp)) {		
			$ret .= fgets($fp,1024);				
		}	
			
		if($ret){
			$ret = $this->exp_url($ret);
			$this->error=$ret['num'];
			$this->v = $ret['err'];
		}else{		
			$this->error=-1;
			$this->v = "未获取到返回值";
			return;
		}
		return $ret;
		
	}
	public function GetBalance_new(){
			$mobile = $this->mobile['cfg_mobile_1'];			
			$name = urlencode($mobile['mid']);
			$pwd  = $mobile['mpass'];			
			
			$fp=fopen("http://203.81.21.34/send/getfee.asp?name=$name&pwd=$pwd","r");
			if(!$fp){
				$fp=fopen("http://203.81.21.13/send/getfee.asp?name=$name&pwd=$pwd","r");
			}
			if(!$fp){
				$fp=fopen("http://www.139000.com/send/getfee.asp?name=$name&pwd=$pwd","r");
			}
			
			if(!$fp){
				fclose($fp);	
				return array("-1","打开文件发送失败");
			}			
			
			$ret = '';
			while (!feof($fp)) {				
				$ret .= fgets($fp,1024);				
			}									
			
			if($ret){				
				$ret = $this->exp_url($ret);			
			}else{
				return array("-1","未获取到返回值");
			}
			
			if($ret['id'] == '-9999' || $ret['id'] == '0'){
				$ret['id'] = 0;
			}else{
				$ret['id'] = (intval($ret['id']) / 10);
			}
				
			return $ret;
	}//
	
	
	//内容检测
	public function mobile_con_check($content=null){
		$this->mobile = $mobile = System::load_sys_config('mobile');
		$mobile = $this->mobile['cfg_mobile_1'];	
		$name = urlencode($mobile['mid']);
		$pwd  = $mobile['mpass'];
		$content = iconv( "UTF-8", "gb2312//IGNORE" ,$content);
		$content = urlencode($content);	
		
		$con_check=fopen("http://www.139000.com/send/checkcontent.asp?name=$name&pwd=$pwd&content=$content","r");
		if(!$con_check){
			fclose($con_check);				
		}
		
		$rets = '';
		while (!feof($con_check)) {				
			$rets .= fgets($con_check,1024);				
		}
					
		if($rets){
				$rets = $this->exp_url($rets);
				if($rets['errid']=='0'){
					return array("1","新短信接口内容合法");
				}else{
					return array("-1","内容检测失败,不能包含:【".$rets['err'].'】');
				}
		}else{
			return array("-1","检测失败");
		}
	
	}
	
	//URL转数组
	private function exp_url($url=''){
		if(!empty($url)){
			$ret = iconv("GB2312","UTF-8",$url);
			$ret = explode("&",$ret);
				foreach($ret as $k=>$v){
					$v = explode("=",$v);
					$ret[$v[0]] = $v[1];
				}
			return $ret;
		}else{
			return false;
		}
		
	}//
	
}

	



?>