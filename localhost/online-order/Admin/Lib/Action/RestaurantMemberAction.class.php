<?php
// 餐馆会员模块
class RestaurantMemberAction extends CommonAction {
	
	function _filter(&$map){
		$map['account'] = array('like',"%".$_POST['account']."%");	
	}
	public function password(){
		$this->display();	
	}

	public function _before_insert(){
		$account = $_REQUEST['account'];
		$RestaurantMember = M('RestaurantMember');
		$rs = $RestaurantMember->where(array('account'=>$account))->find();
		if($rs){
			$this->error('用户名已存在');	
		}
		$_POST['password'] = md5($_POST['password']);
		$this->uploadfile();
	}
	public function _before_update(){
			if(isset($_FILES['logo']) && !empty($_FILES['logo'])&& $_FILES['logo']['error']==0){
				$this->uploadfile();	
			}
		}
    //重置密码
    public function resetPwd()
    {
    	$id  =  $_POST['id'];
        $password = $_POST['password'];
        if(''== trim($password)) {
        	$this->error('密码不能为空！');
        }
        $RestaurantMember = M('RestaurantMember');
		$RestaurantMember->password	=	md5($password);
		$RestaurantMember->id			=	$id;
		$RestaurantMember->update_time  =   time(); 
		$result	=	$RestaurantMember->save();
        if(false !== $result) {
            $this->success("密码修改为$password");
        }else {
        	$this->error('重置密码失败！');
        }
    }

	public function BusinessStatus(){
		$id = $_REQUEST['id'];
		$RestaurantMember = M('RestaurantMember');
		$business_status = $RestaurantMember->where(array('id'=>$id))->getField('business_status');
		if($business_status == '1'){
			$map['business_status'] = '0';	
		}else{
			$map['business_status'] = '1';	
		}
		
		$rs = $RestaurantMember->where(array('id'=>$id))->save($map);
		//$this->error($RestaurantMember->getLastSql());
		if($rs){
			$this->success('操作成功');	
		}else{
			$this->error('操作失败');	
		}
	}
	public function uploadfile(){
		import('@.ORG.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 2097152 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  'Public/Uploads/Logo/'.date('Ymd',time()).'/';// 设置附件上传目录
			$upload->saveRule = 'uniqid';
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功
				$info = $upload->getUploadFileInfo();
				$_POST['logo'] = '/'.$info[0]['savepath'].$info[0]['savename'];
			}		
	}


}

?>