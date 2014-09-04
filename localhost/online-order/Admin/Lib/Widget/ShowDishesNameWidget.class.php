<?php
//菜名
	class ShowDishesNameWidget extends Widget{
			 public function render($data){
					 	$dishes_id = $data['dishes_id'];
						$Dishes = M('Dishes'); 
						$dishes_name = $Dishes->field('dishes_name,price')->where(array('id'=>$dishes_id))->find();
						if(empty($data['type'])){
							$content = $dishes_name['dishes_name'].'（$'.$dishes_name['price'].'）';
						}else{
							$content = $dishes_name['dishes_name'];	
						}
						return $content;
				 } 
		}
?>