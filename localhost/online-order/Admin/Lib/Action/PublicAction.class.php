<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

class PublicAction extends Action {
	// 检查用户是否登录

	protected function checkUser() {
		if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->assign('jumpUrl','Public/login');
			$this->error('没有登录');
		}
	}

	// 菜单页面
/*	public function menu() {
        $this->checkUser();
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            //显示菜单项
            $menu  = array();

        	//读取数据库模块列表生成菜单项
			$node    =   M("Node");
			$id	=	$node->getField("id");
			$where['level']=2;
			$where['status']=1;
			$where['pid']=$id;
			$list	=	$node->where($where)->field('id,name,group_id,title')->order('sort asc')->select();
			$accessList = $_SESSION['_ACCESS_LIST'];
			foreach($list as $key=>$module) {
			     if(isset($accessList[strtoupper(APP_NAME)][strtoupper($module['name'])]) || $_SESSION['administrator']) {
				//设置模块访问权限
				$module['access'] =   1;
				$menu[$key]  = $module;
			    }
			}

            if(!empty($_GET['tag'])){
                $this->assign('menuTag',$_GET['tag']);
            }
			//dump($menu);
            $this->assign('menu',$menu);
		}
		C('SHOW_RUN_TIME',false);			// 运行时间显示
		C('SHOW_PAGE_TRACE',false);
		$this->display();
	}*/

	public function menu() {
        $this->checkUser();
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            //显示菜单项
            $menu  = array();
            if(isset($_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]]) and false) {//and false 不缓存
                //如果已经缓存，直接读取缓存
                $menu   =   $_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]];
            }else {
                $node    =   M("Node");
                $list = $node->field('name,title,group_id')
                    ->where(array('level'=>2,'status'=>1,'pid'=>1))
                    ->order('sort DESC')
                    ->select();

                $Group = D('Group');
                $g_list = $Group->field('id,name,title,parent_id')->where(array('status'=>1))->order('parent_id,sort DESC')->select();
                foreach($g_list as $vo){
                    $group_list[$vo['id']] = $vo;
                }
                //print_r($group_list);
                $accessList = $_SESSION ['_ACCESS_LIST'];
                foreach ( $list as $key => $module ) {
                    if(isset ($accessList[strtoupper (APP_NAME)][strtoupper($module ['name'])]) || $_SESSION['administrator']) {//如果具备访问权限
                        //设置模块访问权限
                        $module ['access'] = 1;
                        if(!empty($group_list[$module['group_id']])){
                            $group_list[$module['group_id']]['node'][] = $module;
                        }
                    }
                }
                foreach($group_list as $group){
                    if($group['parent_id'] == 0){
                        $menu[$group['id']] = $group;
                    }else{
                        $menu[$group['parent_id']]['node'][] = $group;
                    }
                }
                //print_r($menu);exit;
                //缓存菜单访问
                $_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]]	=	$menu;
            }
            $this->assign('menu',$menu);
        }
        $this->display();
	}

    // 后台首页 查看系统信息
    public function main() {
        $info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            'ThinkPHP版本'=>THINK_VERSION.' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
            'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
            );
        $this->assign('info',$info);
        $this->display();
    }

    /*public function test(){
        echo "test page...";
    }*/

	// 用户登录页面
	public function login() {
		if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->display();
		}else{
            //print_r($_SESSION[C('USER_AUTH_KEY')]);
			$this->redirect('Index/index');
            //$this->redirect('Public/test');
		}
	}
	public function index()
	{
		//如果通过认证跳转到首页
		redirect(__APP__);
	}

	// 用户登出
    public function logout()
    {
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
			unset($_SESSION[C('USER_AUTH_KEY')]);
			unset($_SESSION);
			session_destroy();
            $this->assign("jumpUrl",__URL__.'/login/');
            $this->success('登出成功！');
        }else {
            $this->error('已经登出！');
        }
    }

	// 登录检测
	public function checkLogin() {

		if(empty($_POST['account'])) {
			$this->error('帐号错误！');
		}elseif (empty($_POST['password'])){
			$this->error('密码必须！');
		}/*elseif (empty($_POST['verify'])){
			$this->error('验证码必须！');
		}*/
        //生成认证条件
        $map            =   array();
		// 支持使用绑定帐号登录
		$map['account']	= $_POST['account'];
        $map["status"]	=	array('gt',0);
		/*if($_SESSION['verify'] != md5($_POST['verify'])) {
			$this->error('验证码错误！');
		}*/
		import ( '@.ORG.RBAC' );
        $authInfo = RBAC::authenticate($map);
        //使用用户名、密码和状态的方式进行认证
        if(false === $authInfo) {
            $this->error('帐号不存在或已禁用！');
        }else {
            if($authInfo['password'] != md5($_POST['password'])) {
            	$this->error('密码错误！');
            }
            $_SESSION[C('USER_AUTH_KEY')]	=	$authInfo['id'];
            $_SESSION['email']	=	$authInfo['email'];
            $_SESSION['loginUserName']		=	$authInfo['nickname'];
            $_SESSION['lastLoginTime']		=	$authInfo['last_login_time'];
			$_SESSION['login_count']	=	$authInfo['login_count'];
            if($authInfo['account']=='admin' || $authInfo['account']=='zengwenjiao') {
            	$_SESSION['administrator']		=	true;
            }
            //保存登录信息
			$User	=	M('User');
			$ip		=	get_client_ip();
			$time	=	time();
            $data = array();
			$data['id']	=	$authInfo['id'];
			$data['last_login_time']	=	$time;
			$data['login_count']	=	array('exp','login_count+1');
			$data['last_login_ip']	=	$ip;
			$User->save($data);

			// 缓存访问权限
            RBAC::saveAccessList();
			$this->success('登录成功！');

		}
	}
    // 更换密码
    public function changePwd()
    {
        if($_POST)
        {
            $this->checkUser();
            //对表单提交处理进行处理或者增加非表单数据
            /*if(md5($_POST['verify'])  != $_SESSION['verify']) {
                $this->error('验证码错误！');
            }*/
            $map    =   array();
            $map['password']= pwdHash($_POST['oldpassword']);
            if(isset($_POST['account'])) {
                $map['account']  =   $_POST['account'];
            }elseif(isset($_SESSION[C('USER_AUTH_KEY')])) {
                $map['id']      =   $_SESSION[C('USER_AUTH_KEY')];
            }
            //检查用户
            $User    =   M("User");
            if(!$User->where($map)->field('id')->find()) {
                $this->error('旧密码不符或者用户名错误！');
            }else {
                $User->password =   pwdHash($_POST['password']);
                $User->save();
                $this->success('密码修改成功！');
            }
        }
		
        $this->display('password');
    }
	public function profile() {
		$this->checkUser();
		$User	 =	 M("User");
		$vo	=	$User->getById($_SESSION[C('USER_AUTH_KEY')]);
		$this->assign('vo',$vo);
		$this->display();
	}
	public function verify()
    {
		$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("@.ORG.Image");
        Image::buildImageVerify(4,1,$type);
    }
// 修改资料
	public function change() {
		$this->checkUser();
		$User	 =	 D("User");
		if(!$User->create()) {
			$this->error($User->getError());
		}
		$result	=	$User->save();
		if(false !== $result) {
			$this->success('资料修改成功！');
		}else{
			$this->error('资料修改失败!');
		}
	}
	//添加新餐馆
	public function addRestaurant()
	{
		//echo $_SESSION[C('USER_AUTH_KEY')];
		$RestaurantMember = M('restaurant_member');
		$User = M('user');
		$info = $User->where(array('id' => $_SESSION[C('USER_AUTH_KEY')]))->find();
		if($_POST['btnSave'])
			{
				$data['user_id']				=	$_SESSION[C('USER_AUTH_KEY')];
				$data['account']				=	$info['account'];
				$data['password']				=	$info['password'];
				$data['email']					=	$_POST['email'];
				$data['nickname']				=	$_POST['catname'];
				$data['phone']					=	$_POST['phone'];
				$data['resfax']					=	$_POST['fax'];
				$data['zip']					=	$_POST['rest_zip'];
				$data['address']				=	$_POST['rest_address'];
				$data['remark']					=	$_POST['meta_description'];
				$data['city']					=	$_POST['rest_city'];
				$data['state']					=	$_POST['rest_state'];
				$data['delivery_radius']		=	$_POST['delivery_radius'];
				$data['order_minimum']			=	$_POST['order_minimum'];
				$data['tax']					=	$_POST['tax_percent'];
				$data['delivery_charges']		=	$_POST['delivery_charges'];
				$data['announcements']			=	$_POST['rest_announcements'];
				$data['announcements_status']	=	$_POST['announcements_status'];
				$data['business_status']		=	$_POST['rest_open_close'];
				$data['facebook_link']			=	$_POST['facebookLink'];
				$data['keywords']				=	$_POST['meta_keywords'];
				$data['create_time']			=	time();
				//print_r($data);exit;
				if(isset($_FILES['image']) && !empty($_FILES['image'])&& $_FILES['image']['error']==0)
				{
					$data['logo']			=	$this->uploadfile();	
				}else
				{
					$data['logo']			=	$_POST['logo'];
				}
				$result = $RestaurantMember->add($data);
				if($result)
					{
						$this->redirect('/Index/index');
					}
				
				
			}	
			
		
		$this->assign('info',$info);
		$this->assign('restaurant_id',$_SESSION['restaurant_id']);
		$this->display();
	}
}
?>