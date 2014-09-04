<?php
//菜名
	class ShowAddItemWidget extends Widget{
			 public function render($data){
					 	$ids = $data['ids'];
						
						$DishesItem = M('DishesItem');
						$list = $DishesItem->field('item_name,add_price')->where(array('id'=>array('in',$ids)))->select();
						foreach($list as $key=>$val){
							$content .= $val['item_name'].'（$'.$val['add_price'].'）&nbsp';
						}
						return $content;
						
				 } 
		}
?>