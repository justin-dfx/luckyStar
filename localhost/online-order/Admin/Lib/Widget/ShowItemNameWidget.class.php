<?php
//菜名
	class ShowItemNameWidget extends Widget{
			 public function render($data){
				 		$id = $data['item_id'];
						if($id != '0'){
							$DishesItem = M('DishesItem');
							$item_name = $DishesItem->field('item_name')->where(array('id'=>$id))->find();
							$name = $item_name['item_name'];
						}else{
							$name = 'Top';
						}
				 		return $name;
				 } 
		}
?>