<?php
// 菜品增加项目模块
class DishesItemAction extends CommonAction {
		public function _search(){
			$Dishes = M('Dishes');
			$dishes_ids = $Dishes->field('id')->findAll();
			foreach($dishes_ids as $k=>$v){
				if($k){
					$ids .= ','.$v['id'];
				}else{
					$ids .= $v['id'];	
				}	
			}
			$map['dishes_id'] = array('in',$ids);
			if(!empty($_POST['item_name'])){
				$map['item_name'] = array('like','%'.$_POST['item_name'].'%');	
			}
			if(!empty($_REQUEST['dishesid'])){
				$map['dishes_id'] = $_REQUEST['dishesid'];
			}
			return $map;
		}
		public function _before_add(){
			$Dishes = M('Dishes');
			$dishes_list = $Dishes->field('id,dishes_name')->select();
			$DishesItem = M('DishesItem');
			$dishes_ids = $this->_search();
			$item_list = $DishesItem->field('id,item_name')->where(array('p_id'=>0,'dishes_id'=>array('in',$dishes_ids['dishes_id'])))->select();
			$this->assign('item_list',$item_list);
			$this->assign('dishes_list',$dishes_list);
		}
		public function _before_edit(){
			$Dishes = M('Dishes');
			$dishes_list = $Dishes->field('id,dishes_name')->select();
			$DishesItem = M('DishesItem');
			$dishes_ids = $this->_search();
			$item_list = $DishesItem->field('id,item_name')->where(array('p_id'=>0,'dishes_id'=>array('in',$dishes_ids['dishes_id'])))->select();
			$this->assign('item_list',$item_list);
			$this->assign('dishes_list',$dishes_list);
		}
		public function _before_insert(){
			
		}
		public function BelongDishes(){	
			$Dishes = M('Dishes');
			$DishesItem = M('DishesItem');
			
			if($_REQUEST['item_id'] > 0){
				$dishes_id = $DishesItem->field('dishes_id')->where(array('id'=>$_REQUEST['item_id']))->find();	
				$where['id'] = $dishes_id['dishes_id'];
			}
			$dishes_list = $Dishes->field('id,dishes_name')->where($where)->select();
			
			$this->assign('dishes_list',$dishes_list);
			$this->display();	
		}
		
}
?>