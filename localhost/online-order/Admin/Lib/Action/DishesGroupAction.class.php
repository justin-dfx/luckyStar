<?php
// 菜组模块
class DishesGroupAction extends CommonAction {
		public function _search(){
			if(!empty($_POST['group_name'])){
				$map['group_name'] = array('like','%'.$_POST['group_name'].'%');	
			}
			if(!empty($_REQUEST['restaurant_id'])){
				$map['restaurant_id'] = $_REQUEST['restaurant_id'];
			}
			return $map;
		}
		public function _before_add(){
			$this->_RestaurantList();	
		}
		public function _before_edit(){
			$this->_RestaurantList();	
		}
		public function _before_update(){
			$DishesGroup = M('DishesGroup');
			$Dishes = M('Dishes');
			$res_id = $DishesGroup->where(array('id'=>$_POST['id']))->getField('restaurant_id');
			if($res_id != $_POST['restaurant_id']){
				$Dishes->where(array('group_id'=>$_POST['id']))->save(array('restaurant_id'=>$_POST['restaurant_id']));	
			}
		}
		public function _RestaurantList(){
			$RestaurantMember = M('RestaurantMember');
			$rs_list = $RestaurantMember->field('id,nickname')->select();
			$this->assign('rs_list',$rs_list);
		}
}
?>