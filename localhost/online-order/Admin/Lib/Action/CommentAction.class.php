<?php
// 评论模块
class CommentAction extends CommonAction {
		public function _search(){
			if(!empty($_POST['content'])){
				$map['content'] = array('like','%'.$_POST['content'].'%');	
			}	
			return $map;
		}
}
?>