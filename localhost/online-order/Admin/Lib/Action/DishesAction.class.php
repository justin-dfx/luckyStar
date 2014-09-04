<?php
// 菜品模块
class DishesAction extends CommonAction {
		public function _search(){
			if(!empty($_POST['dishes_name'])){
				$map['dishes_name'] = array('like','%'.$_POST['dishes_name'].'%');	
			}
			if(!empty($_REQUEST['groupid'])){
				$map['group_id'] = $_REQUEST['groupid'];
			}
			return $map;
		}

		public function _before_add(){
			$DishesGroup = M('DishesGroup');
			$group_list = $DishesGroup->field('id,group_name')->select();	
			$this->assign('group_list',$group_list);
		}
		public function _before_insert(){
			$DishesGroup = M('DishesGroup');
			$start = $_POST['start'];
			$end = $_POST['end'];
			if(empty($start) && !empty($end)){
				$this->error('Please select the start time');	
			}
			if(!empty($start) && empty($end)){
				$this->error('Please select the end time');		
			}
			$_POST['openhours'] = $start.'-'.$end;
			$restaurant_id = $DishesGroup->where(array('id'=>$_POST['group_id']))->getField('restaurant_id');
			$_POST['restaurant_id'] = $restaurant_id;
			if(isset($_FILES['image']) && !empty($_FILES['image'])&& $_FILES['image']['error']==0){
				$this->uploadfile();
			}
		}
		public function _before_edit(){
			$DishesGroup = M('DishesGroup');
			$Dishes = M('Dishes');
			$id = $_REQUEST['id'];
			$openhours = $Dishes->where(array('id'=>$id))->getField('openhours');
			$oh_arr = explode('-',$openhours);
			$list['start'] = $oh_arr[0];
			$list['end'] = $oh_arr[1];
			$group_list = $DishesGroup->field('id,group_name')->select();	
			$this->assign('list',$list);
			$this->assign('group_list',$group_list);
		}
		public function _before_update(){
			if(isset($_FILES['image']) && !empty($_FILES['image'])&& $_FILES['image']['error']==0){
				$this->uploadfile();	
			}
			$_POST['openhours'] = $_POST['start'].'-'.$_POST['end'];
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
			}	
		}

}
?>