<?php
//菜名
	class ShowRestaurantWidget extends Widget{
			 public function render($data){
					 	$id = $data['id'];
						$RestaurantMember = M('RestaurantMember'); 
						$nickname = $RestaurantMember->where(array('id'=>$id))->getField('nickname');
						return $nickname;
				 } 
		}
?>