<?php
class IndexAction extends CommonAction {
	
	// 框架首页
	/*public function index() {
		//print_r($_SESSION);
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            //显示菜单项
            $menu  = array();
            if(isset($_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]]) and false) {//and false 不缓存
                //如果已经缓存，直接读取缓存
		
                $menu   =   $_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]];
            }else {
				if($_SESSION['administrator'] != 1){
					$RoleUser = M('RoleUser');
					$Access = M('Access');
					$role_ids = $RoleUser->field('role_id')->where(array('user_id'=>$_SESSION[C('USER_AUTH_KEY')]))->select();
					foreach($role_ids as $key=>$val){
						if($key){
							$node_where .= ' or role_id = '.$val['role_id'];	
						}else{
							$node_where = 'role_id = '.$val['role_id'];
						}
					}
					$node_arr = $Access->field('node_id')->where($node_where)->group('node_id')->select();		
					foreach($node_arr as $k=>$v){
						$node_ids[$k] = $v['node_id'];	
					}
					$where = array('level'=>2,'status'=>1,'pid'=>1,'id'=>array('in',$node_ids));
				}else{
					$where = array('level'=>2,'status'=>1,'pid'=>1,);	
				}
				
                $node    =   M("Node");
                $list = $node->field('name,title,group_id')->where($where)->order('sort DESC')->select();
                $Group = D('Group');
                $g_list = $Group->field('id,name,title')->where(array('status'=>1))->order('sort DESC')->select();
				
                foreach($g_list as $vo){
                    $group_list[$vo['id']] = $vo;
				}
                $accessList = $_SESSION ['_ACCESS_LIST'];
                foreach ( $list as $key => $module ) {
                        $module ['access'] = 1;
                        if(!empty($group_list[$module['group_id']])){
                            $group_list[$module['group_id']]['node'][] = $module;
                        }
                }
				
                foreach($group_list as $group){
                    if($group['parent_id'] == 0){
                        $menu[$group['id']] = $group;
                    }else{
                        $menu[$group['parent_id']]['node'][] = $group;
                    }
                }
				
                $_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]]	=	$menu;
            }
            $this->assign('menu',$menu);
        }
        $this->display();

    }*/
    public function index()
    {
        $Restaurant = M('Restaurant_member');
        $Order = M('Billhead');
        if($_SESSION[C('USER_AUTH_KEY')])
        {
            $list = $Restaurant->where(array('user_id' => $_SESSION[C('USER_AUTH_KEY')]))->select();
            $restaurant_count = $Restaurant->where(array('user_id' => $_SESSION[C('USER_AUTH_KEY')]))->count();
            $Order_count = $Order->where(array('restaurant_id' => $_SESSION['restaurant_id']))->count();
            $_SESSION['restaurant_count'] = $restaurant_count;
            $_SESSION['order_count'] = $Order_count;

        }
        $this->assign('list',$list);
        $this->display();
    }
}
?>