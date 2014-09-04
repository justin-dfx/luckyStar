<?php
// Cuisine Action
class MenusAction extends CommonAction {
	/*public function _before_add(){
		$restaurant_id = $_REQUEST['restaurant_id'];
		$this->assign('restaurant_id',$restaurant_id);
	}*/
	public function index()
	{
		$Cuisine = M('Cuisine');
		$Menugroup = M('Menugroup');
		$Item = M('Item');
		$Package = M('Packagelist');
		$PackageGroup = M('Package_group');
		//cuisine list
		$Cuisine_id = $_GET['cuisine_id'];
		if($_SESSION['restaurant_id'])
		{
			$list = $Cuisine->where(array('restaurant_id' => $_SESSION['restaurant_id']))->order('ordering asc')->select();
		}
		//SubMenu list
		if($Cuisine_id)
		{
			$groupList = $Menugroup->where(array('restaurant_id' => $_SESSION['restaurant_id'],'cuisine_id' => $Cuisine_id))->order('ordering asc')->select();
			foreach($groupList AS $key => $row)
			{
				$groupList[$key]['itemlist']   = $Item->where(array('group_id' => $groupList[$key]['id']))->order('id desc')->select();
			}
			$packageList = $Package->where(array('restaurant_id' => $_SESSION['restaurant_id'],'cuisine_id' => $Cuisine_id))->order('id desc')->select();
			foreach($packageList AS $key => $row)
			{
				$packageList[$key]['groupList'] = $PackageGroup->where(array('restaurant_id' => $_SESSION['restaurant_id'],'cuisine_id' => $findOne['id'],'package_id' => $packageList[$key]['id']))->select();
			}
			//$packageGroupList = $PackageGroup->where(array('restaurant_id' => $_SESSION['restaurant_id'],'cuisine_id' => $findOne['id']))->select();
			
		}else
		{
			$findOne = $Cuisine->where(array('restaurant_id' => $_SESSION['restaurant_id']))->order('ordering asc')->find();
			$groupList = $Menugroup->where(array('restaurant_id' => $_SESSION['restaurant_id'],'cuisine_id' => $findOne['id']))->order('ordering asc')->select();
			foreach($groupList AS $key => $row)
			{
				$groupList[$key]['itemlist']  = $Item->where(array('group_id' => $groupList[$key]['id']))->order('id desc')->select();
			}
			$packageList = $Package->where(array('restaurant_id' => $_SESSION['restaurant_id'],'cuisine_id' => $findOne['id']))->order('id desc')->select();
			foreach($packageList AS $key => $row)
			{
				$packageList[$key]['groupList'] = $PackageGroup->where(array('restaurant_id' => $_SESSION['restaurant_id'],'cuisine_id' => $findOne['id'],'package_id' => $packageList[$key]['id']))->select();
			}
			//$packageGroupList = $PackageGroup->where(array('restaurant_id' => $_SESSION['restaurant_id'],'cuisine_id' => $findOne['id']))->select();

		}
		//print_r($groupList);
		$this->assign('list',$list);
		$this->assign('groupList',$groupList);
		$this->assign('packageList',$packageList);
		$this->assign('packageGroupList',$packageGroupList);
		$this->display();
	}
	//add_cuisine and edit_cuisine
	public function add_Cuisine()
	{
		$Cuisine = M('Cuisine');
		$id = $_GET['id'];
		if($_POST['submit'])
		{
			if($_POST['gid'])
			{//edit_cuisine
				$data['restaurant_id']	=	$_POST['restaurant_id'];
				$data['remark']			=	$_POST['menu_desc'];
				$data['cuisine_name']	=	$_POST['menu_name'];
				$data['cuisine_name2']	=	$_POST['menu_name2'];
				$data['ordering']		=	$_POST['menu_ordering'];
				$data['update_time']	=	time();
				$result = $Cuisine->where(array('id' => $_POST['gid']))->save($data);
			}else
			{//add_cuisine
				$data['restaurant_id']	=	$_POST['restaurant_id'];
				$data['remark']			=	$_POST['menu_desc'];
				$data['cuisine_name']	=	$_POST['menu_name'];
				$data['cuisine_name2']	=	$_POST['menu_name2'];
				$data['ordering']		=	$_POST['menu_ordering'];
				$data['create_time']	=	time();
				$result = $Cuisine->add($data);
			}
			if($result)
			{
				$this->redirect('/Menus/index');
			}
		}
		$info = $Cuisine->where(array('id' => $id))->find();
		$this->assign('info',$info);
		$this->assign('restaurant_id',$_SESSION['restaurant_id']);
		$this->display();
	}

	//delete_cuisine
	public function delete_Cuisine()
	{
		$Cuisine = M('Cuisine');
		$Menugroup = M('Menugroup');
		$Item = M('Item');
		$Cuisine_id = $_GET['cuisine_id'];
		if($Cuisine_id)
		{
			$result_item = $Item->where(array('cuisine_id' => $Cuisine_id))->delete();
			$result_group = $Menugroup->where(array('cuisine_id' => $Cuisine_id))->delete();
			$result_cuisine = $Cuisine->where(array('id' => $Cuisine_id))->delete();
			if($result_cuisine)
			{
				$this->redirect('/Menus/index');
			}
		}
	}
	//add_SubMenu and edit_SubMenu
	public function add_SubMenu()
	{
		$Cuisine = M('Cuisine');
		$Menugroup = M('Menugroup');
		$group_id = $_GET['group_id'];
		if($_POST['submit'])
		{
			if($_POST['gid'])
			{//edit_cuisine
				$data['cuisine_id']		=	$_POST['cuisine_name'];
				$data['restaurant_id']	=	$_SESSION['restaurant_id'];
				$data['group_name']		=	$_POST['menu_name'];
				$data['group_name2']	=	$_POST['menu_name2'];
				$data['remark']			=	$_POST['menu_desc'];
				$data['update_time']	=	time();
				$result = $Menugroup->where(array('id' => $_POST['gid']))->save($data);
			}else
			{//add_cuisine
				$data['cuisine_id']		=	$_POST['cuisine_name'];
				$data['restaurant_id']	=	$_SESSION['restaurant_id'];
				$data['group_name']		=	$_POST['menu_name'];
				$data['group_name2']	=	$_POST['menu_name2'];
				$data['remark']			=	$_POST['menu_desc'];
				$data['create_time']	=	time();
				$result = $Menugroup->add($data);
			}
			if($result)
			{
				$this->redirect('/Menus/index');
			}
		}
		$list = $Cuisine->where(array('restaurant_id' => $_SESSION['restaurant_id']))->select();
		$info = $Menugroup->where(array('id' => $group_id))->find();
		$this->assign('info',$info);
		$this->assign('list',$list);
		$this->display();
	}
	//delete_submenu
	public function delete_SubMenu()
	{
		$Menugroup = M('Menugroup');
		$Item = M('Item');
		$group_id = $_GET['group_id'];
		if($group_id)
		{
			$result_item	=	$Item->where(array('group_id' => $group_id))->delete();
			$result_group	=	$Menugroup->where(array('id' => $group_id))->delete();
			if($result_group)
			{
				$this->redirect('/Menus/index');
			}
		}
	}
	//add_item
	public function add_Item()
	{
		$Cuisine 	= 	M('Cuisine');
		$Menugroup 	= 	M('Menugroup');
		$Item 		= 	M('Item');
		$group_id	= 	$_GET['group_id'];
		$item_id 	= 	$_GET['item_id'];
		$list 		= $Menugroup->where(array('id' => $group_id))->find();
		//print_r($list);
		$data['restaurant_id']			=	$_SESSION['restaurant_id'];
		$data['cuisine_id']				=	$_POST['cuisine_id'];
		$data['group_id']				=	$_POST['group_id'];
		$data['item_name']				=	$_POST['item_name'];
		$data['item_name2']				=	$_POST['item_name2'];
		$data['description']			=	$_POST['item_desc'];
		$data['description_chinese']	=	$_POST['item_desc2'];
		$data['price']					=	$_POST['price'];
		
		//print_r($data);
		if(isset($_FILES['image']) && !empty($_FILES['image'])&& $_FILES['image']['error']==0)
		{
			$data['imagesrc']			=	$this->uploadfile();	
		}else
		{
			$data['imagesrc']			=	$_POST['imagesrc'];
		}			
		if($_POST['submit'])
		{
			if($_POST['gid'])
			{//edit_time
				$data['update_time']			=	time();
				$result = $Item->where(array('id' => $_POST['gid']))->save($data);
				if($result)
				{
					$this->redirect('/Menus/index');
				}
			}else
			{//add_item
				$data['create_time']			=	time();
				$result = $Item->add($data);
				if($result)
				{
					$result_info = $Item->where(array('id' => $result))->find();
					$this->redirect('/Menus/add_Item',array('group_id' => $result_info['group_id']));
				}
			}
			
			
		}else if($_POST['submit1'])
		{
			$data['create_time']			=	time();
			$result = $Item->add($data);
			if($result)
			{
				$this->redirect('/Menus/index');
			}
		}
		$info  = $Item->where(array('id' => $item_id))->find();
		$this->assign('cuisine_id',$list['cuisine_id']);
		$this->assign('group_id',$list['id']);
		$this->assign('info',$info);
		$this->display();
	}
	//delete_item
	public function delete_Item()
	{
		$Item = M('Item');
		$item_id = $_GET['item_id'];
		if($item_id)
		{
			$result = $Item->where(array('id' => $item_id))->delete();
			if($result)
			{
				$this->redirect('/Menus/index');
			}
		}
		
	}
	//add_optiongroup
	public function add_Package()
	{
		$Package = M('Packagelist');
		$Cuisine = M('Cuisine');
		$Package_id = $_GET['package_id'];
		$data['restaurant_id']	=	$_SESSION['restaurant_id'];
		$data['cuisine_id']	=	$_POST['cuisine_name'];
		/*$data['cuisine_id']	=	
		$data['group_id']		=
		$data['type_id']		=	*/
		$data['group_name']		=	$_POST['group_name'];
		$data['group_name2']	=	$_POST['group_name2'];
		$data['group_type']		=	$_POST['group_type'];
		/*$data['group_qty']*/
		$data['price']			=	$_POST['price'];
		if($_POST['submit'])
		{
			if($_POST['gid'])
			{
				$data['update_time']	=	time();
				$result = $Package->where(array('id' => $_POST['gid']))->save($data);
			}else
			{
				$data['create_time']	=	time();
				$result = $Package->add($data);
			}
			
			if($result)
			{
				if($_POST['submit'] == "Add Group")
				{
					$this->redirect('/Menus/add_GroupOption');
				}else
				{
					$this->redirect('/Menus/index');
				}
				
			}
		}
		$CuisineList = $Cuisine->where(array('restaurant_id' => $_SESSION['restaurant_id']))->order('ordering asc')->select();
		$info = $Package->where(array('id' => $Package_id))->find();//print_r($info);
		$this->assign('info',$info);
		$this->assign('CuisineList',$CuisineList);
		
		
		
		$this->display();
	}
	//delete_package
	public function delete_package()
	{
		$Package = M('Packagelist');
		$PackageGroup = M('Package_group');
		$Package_id = $_GET['package_id'];
		if($Package_id)
		{
			$result = $Package->where(array('id' => $Package_id))->delete();
			if($result)
			{
				$result_package_group = $PackageGroup->where(array('package_id' => $Package_id))->delete();
				$this->redirect('/Menus/index');
			}
		}
	}
	//add_groupoption
	public function add_GroupOption()
	{
		$Package = M('Packagelist');
		$Menugroup = M('Menugroup');
		$Item = M('Item');
		$PackageGroup = M('Package_group');
		$ItemAttribute = M('Item_attribute');
		$info = $Package->where(array('restaurant_id' => $_SESSION['restaurant_id']))->order('id desc')->find();
		$submenulist= $Menugroup->where(array('restaurant_id' => $_SESSION['restaurant_id'],'cuisine_id' => $info['cuisine_id']))->select();
		$itemlist= $Item->where(array('restaurant_id' => $_SESSION['restaurant_id']))->select();
		if($_POST['submit1'])
		{
			
			$data['restaurant_id']	=	$_SESSION['restaurant_id'];
			$data['cuisine_id']		=	$info['cuisine_id'];
			$data['package_id']		=	$info['id'];
			$data['group_id']		=	$_POST['option'];
			$data['item_id']		=	implode(',',$_REQUEST['item_name_show']);
			$data['group_name']		=	$_POST['option_name'];
			$data['group_name2']	=	$_POST['option_name2'];
			$data['group_type']		=	$_POST['option_type'];
			$data['max_select']		=	$_POST['max_select'];
			$data['create_time']	=	time();
			$result = $PackageGroup->add($data);
			if($result)
			{
				$data1['restaurant_id']		=	$_SESSION['restaurant_id'];
				$data1['cuisine_id']		=	$info['cuisine_id'];
				$data1['package_id']		=	$info['id'];
				$data1['group_id']			=	$_POST['option'];
				$data1['package_group_id']	=	$result;
				$data1['item_id']			=	implode(',',$_REQUEST['item_name_show']);
				$data1['is_values']			=	$_POST['attribute_show'];
				$data1['create_time']	=	time();
				
				$result_attribute = $ItemAttribute->add($data1);
				$this->redirect("/Menus/index");
			}

			
			

		}else if($_POST['btnSave'])
		{
			echo 1;	
		}
		$this->assign('info',$info);
		$this->assign('itemlist',$itemlist);
		$this->assign('submenulist',$submenulist);
		$this->display();
	}
	public function item_table_show()
	{
		$id = $_POST['id'];
		$Item = M('Item');
		$itemList = $Item->where(array('group_id' => $id,'restaurant_id' => $_SESSION['restaurant_id']))->select();

			//print_r($itemList);
		//$html = "<table width='100%' border='0' cellpadding='3' cellspacing='0'><tbody>";

		      	
         		foreach($itemList AS $key => $value){
         		 $html .= "<input style='margin-left:80px;' class='option-item' type='checkbox'  name='item_name' id='' value='".$value['id']."'/><span class='option-item-name'>".$value['item_name']."(".$value['id'].")</span>";
         		 }
      			
     		
     		echo $html;
   		 //$this->assign('itemList',$itemList);
	}
	/*public function item_true_show()
	{
		$id = $_POST['id'];
		$Item = M('Item');
		$itemTrueList = $Item->where(array('id' => $id,'restaurant_id' => $_SESSION['restaurant_id']))->select();
		//print_r($itemTrueList);
		foreach($itemTrueList AS $key => $va){
         		 $html .= "<span data-id='".$va['id']."'><input class='option-item-true' type='checkbox' checked='checked' name='item_name_show[]' id='' value='".$va['id']."'/>".$va['item_name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
         		 
        }
		echo $html;
		//$this->assign('itemTrueList',$itemTrueList);
	}*/


	//add_attribute
	public function add_Attribute()
	{
		$this->display();
	}
	public function uploadfile(){
		import('@.ORG.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 2097152 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  'Public/Uploads/Images/'.date('Ymd',time()).'/';// 设置附件上传目录
		$upload->saveRule = 'uniqid';
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功
			$info = $upload->getUploadFileInfo();
			$_POST['image'] = '/'.$info[0]['savepath'].$info[0]['savename'];
			return $_POST['image'];
		}	
	}
}

?>