<?php
class NodeAction extends CommonAction {
	public function _search(){
		if(is_numeric($_REQUEST['pid']) and $_REQUEST['pid'] >= 0){
			$map['pid'] = $_REQUEST['pid'];
		}else{
			$map['pid'] = $_REQUEST['pid'] = 1;
			$_REQUEST['level'] = 2;
		}
		if(is_numeric($_REQUEST['group_id']) and $_REQUEST['group_id'] >= 0){
			$map['group_id'] = $_REQUEST['group_id'];
		}
		if(is_numeric($_REQUEST['status']) and $_REQUEST['status'] >= 0 ){
			$map['status'] = $_REQUEST['status'];
		}
		$word = trim($_REQUEST['word']);
		if(!empty($word)){
			$where['_logic'] = 'or';
			$where['name'] = array('like',"%$word%");
			$where['title'] = array('like',"%$word%");
			$map['_complex'] = $where;
		}
		return $map;
	}

	public function _before_index() {
		$model	=	M("Group");
		$list	=	$model->where('status=1')->order('sort DESC')->getField('id,title');
		$this->assign('groupList',$list);
	}

	// 获取配置类型
	public function _before_add() {
		$model	=	M("Group");
		$list	=	$model->where('status=1')->order('sort DESC')->select();
		$this->assign('list',$list);
	}

    public function _before_patch() {
		$model	=	M("Group");
		$list	=	$model->where('status=1')->order('sort DESC')->select();
		$this->assign('list',$list);
		$node	=	M("Node");
		$node->getById($_SESSION['currentNodeId']);
		$this->assign('pid',$node->id);
		$this->assign('level',$node->level+1);
    }
	public function _before_edit() {
		$model	=	M("Group");
		$list	=	$model->where('status=1')->order('sort DESC')->select();
		$this->assign('list',$list);
	}

    /**
     +----------------------------------------------------------
     * 默认排序操作
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
/*    public function sort()
    {
		$node = M('Node');
        if(!empty($_GET['sortId'])) {
            $map = array();
            $map['status'] = 1;
            $map['id']   = array('in',$_GET['sortId']);
            $sortList   =   $node->where($map)->order('sort asc')->select();
        }else{
            if(!empty($_GET['pid'])) {
                $pid  = $_GET['pid'];
            }else {
                $pid  = $_SESSION['currentNodeId'];
            }
            if($node->getById($pid)) {
                $level   =  $node->level+1;
            }else {
                $level   =  1;
            }
            $this->assign('level',$level);
            $sortList   =   $node->where('status=1 and pid='.$pid.' and level='.$level)->order('sort asc')->select();
        }
        $this->assign("sortList",$sortList);
        $this->display();
        return ;
    }*/
}
?>