<?php
//菜名
	class ShowDishesGroupWidget extends Widget{
			 public function render($data){
					 	$id = $data['id'];
						$DishesGroup = M('DishesGroup'); 
						$list = $DishesGroup->field('group_name')->where(array('id'=>$id))->find();
						return $list['group_name'];
				 } 
		}
?>