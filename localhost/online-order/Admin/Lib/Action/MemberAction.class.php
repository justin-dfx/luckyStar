<?php
// 订餐会员模块
class MemberAction extends CommonAction {
	
	function _filter(&$map){
		$map['account'] = array('like',"%".$_POST['account']."%");	
	}
	public function _before_insert(){
		$account = $_REQUEST['account'];
		$_POST['password'] = md5($_POST['password']);
		$Member = M('Member');
		$rs = $Member->where(array('account'=>$account))->find();
		if($rs){
			$this->error('用户名已存在');	
		}
	}
	public function password(){
		$this->display();	
	}
    //重置密码
    public function resetPwd()
    {
    	$id  =  $_POST['id'];
        $password = $_POST['password'];
        if(''== trim($password)) {
        	$this->error('密码不能为空！');
        }
        $Member = M('Member');
		$Member->password	=	md5($password);
		$Member->id			=	$id;
		$Member->update_time  =   time(); 
		$result	=	$Member->save();
        if(false !== $result) {
            $this->success("密码修改为$password");
        }else {
        	$this->error('重置密码失败！');
        }
    }

}

?>