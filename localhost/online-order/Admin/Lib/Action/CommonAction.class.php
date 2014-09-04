<?php
class CommonAction extends Action {
	
	function _initialize() {
		//记录操作日志
		/*$AdminLog = D('bizi_admin_log');
		$AdminLogData = array(
			'create_time' =>time(),
			'user_id' =>$_SESSION['authId'],
			'action'=>parent::getActionName(),
			'function'=>ACTION_NAME,
			'log_info'=>json_encode($_REQUEST),
			'ip_address'=>get_client_ip(),
			'url'		=> __SELF__,
		);
		$AdminLog->add($AdminLogData);*/
		// 用户权限检查
		if (C ( 'USER_AUTH_ON' ) && !in_array(MODULE_NAME,explode(',',C('NOT_AUTH_MODULE')))) {
			import ( '@.ORG.RBAC' );
			if (! RBAC::AccessDecision ()) {
				//检查认证识别号
				if (! $_SESSION [C ( 'USER_AUTH_KEY' )]) {
					//跳转到认证网关
					redirect ( PHP_FILE . C ( 'USER_AUTH_GATEWAY' ) );
				}
				// 没有权限 抛出错误
				if (C ( 'RBAC_ERROR_PAGE' )) {
					// 定义权限错误页面
					redirect ( C ( 'RBAC_ERROR_PAGE' ) );
				} else {
					if (C ( 'GUEST_AUTH_ON' )) {
						$this->assign ( 'jumpUrl', PHP_FILE . C ( 'USER_AUTH_GATEWAY' ) );
					}
					// 提示错误信息
					//$this->error ( L ( '_VALID_ACCESS_' ) );
				}
			}
		}
	}

	public function index($templateFile=false) {
		//列表过滤器，生成查询Map对象
		$map = $this->_search();
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		
		$this->display($templateFile);
		return;
	}
	/**
     +----------------------------------------------------------
	 * 取得操作成功后要返回的URL地址
	 * 默认返回当前模块的默认操作
	 * 可以在action控制器中重载
     +----------------------------------------------------------
	 * @access public
     +----------------------------------------------------------
	 * @return string
     +----------------------------------------------------------
	 * @throws ThinkExecption
     +----------------------------------------------------------
	 */
	function getReturnUrl() {
		return __URL__ . '?' . C ( 'VAR_MODULE' ) . '=' . MODULE_NAME . '&' . C ( 'VAR_ACTION' ) . '=' . C ( 'DEFAULT_ACTION' );
	}

	/**
     +----------------------------------------------------------
	 * 根据表单生成查询条件
	 * 进行列表过滤
     +----------------------------------------------------------
	 * @access protected
     +----------------------------------------------------------
	 * @param string $name 数据对象名称
     +----------------------------------------------------------
	 * @return HashMap
     +----------------------------------------------------------
	 * @throws ThinkExecption
     +----------------------------------------------------------
	 */
	protected function _search() {
		//生成查询条件
		$name=$this->getActionName();
		$model = D ( $name );
		$map = array ();
		foreach ( $model->getDbFields () as $key => $val ) {
			if (isset ( $_REQUEST [$val] ) && $_REQUEST [$val] != '') {
				$map [$val] = $_REQUEST [$val];
			}
		}
		return $map;

	}

	/**
     +----------------------------------------------------------
	 * 根据表单生成查询条件
	 * 进行列表过滤
     +----------------------------------------------------------
	 * @access protected
     +----------------------------------------------------------
	 * @param Model $model 数据对象
	 * @param HashMap $map 过滤条件
	 * @param string $sortBy 排序
	 * @param boolean $asc 是否正序
     +----------------------------------------------------------
	 * @return void
     +----------------------------------------------------------
	 * @throws ThinkExecption
     +----------------------------------------------------------
	 */
	protected function _list($model, $map, $sortBy = '', $asc = false) {
		//排序字段
		$order = empty($_REQUEST['orderField'])?($_REQUEST['orderField'] = $model->getPk()):$_REQUEST['orderField'];
		//排序方式默认按照倒序排列
		$sort = ($_REQUEST['orderDirection'] == 'asc')?($_REQUEST['orderDirection']='asc'):($_REQUEST['orderDirection']='desc');
		//取得满足条件的记录数
		$count = $model->where($map)->count();//echo $model->getLastSql();
		if ($count > 0) {
			if (!empty($_REQUEST ['listRows'] )) {
				$listRows = $_REQUEST ['listRows'];
			} else {
				$listRows = C('PAGE_LISTROWS');//默认没页显示条数
			}			
			$pageNum = is_numeric($_REQUEST['pageNum'])?($_REQUEST['pageNum']-1):0;
			$voList = $model->where($map)->order( "`" . $order . "` " . $sort)->limit(($pageNum*$listRows). ',' . $listRows )->findAll();
			//分页跳转的时候保证查询条件
			foreach ( $map as $key => $val ) {
				if (! is_array ( $val )) {
					$p->parameter .= "$key=" . urlencode ( $val ) . "&";
				}
			}
			$this->assign ( 'list', $voList);
		}
		$this->assign ( 'totalCount', $count );//总条数
		$this->assign ( 'numPerPage', $listRows );//每页显示多少条
		//$this->assign ( 'currentPage', !empty($_GET[C('VAR_PAGE')])?$_GET[C('VAR_PAGE')]:1);//当前第几页
		$this->assign ( 'currentPage',empty($_REQUEST['pageNum'])?1:$_REQUEST['pageNum']);//当前第几页
		Cookie::set ( '_currentUrl_', __SELF__ );
		return;
	}

	public function insert(){
		//B('FilterString');
		$name=$this->getActionName();
		$model = D ($name);
		$fields = $model->getDbFields();
		$_POST['update_time'] = empty($_POST['update_time'])?time():$_POST['update_time'];
		$_POST['create_time'] = empty($_POST['create_time'])?time():$_POST['create_time'];
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		
		//保存当前数据对象
		$list=$model->add ();
		if ($list!==false) { //保存成功
			$this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
			$this->success ('新增成功!');
		} else {
			//失败提示
			$this->error ('新增失败!');
		}
	}

	public function add($templateFile = false){
		$this->display($templateFile);
	}

	function read(){
		$this->edit();
	}

	function edit($templateFile=false) {
		$name = $this->getActionName();
		$model = D( $name);
		$field = $model->getPk();
		$value = $_REQUEST[$field];
		$vo = $model->where( $field .'=' .$value)->find();
		$this->assign('vo', $vo );
		$this->display($templateFile);
	}

	function update(){
		$name=$this->getActionName();
		$model = D($name);
		$_POST['update_time'] = empty($_POST['update_time'])?time():$_POST['update_time'];
		if (false === $model->create()) {
			$this->error($model->getError());
		}
		// 更新数据
		$list=$model->save();
		if (false !== $list) {
			//成功提示
			$this->assign('jumpUrl', Cookie::get('_currentUrl_'));
			$this->success ('编辑成功!');
		} else {
			//错误提示
			$this->error ('编辑失败!');
		}
	}
	/**
	*	修改某字段的值
	*/
	function setField(){
		$name=$this->getActionName();
		$model = D($name);
		$pk = $model->getPk ();
		$id = trim($_REQUEST['id']);
		$val = trim($_REQUEST['val']);//修改的值
		$field = trim($_REQUEST['field']);//需要修改的字段
		$data = array();
		$data[$field] = $val;
		if(empty($id) or !isset($val) or empty($field)){
			$this->ajaxReturn($val,'参数不完整!',0);		
		}
		$_POST['update_time'] = empty($_POST['update_time'])?time():$_POST['update_time'];
		$condition = array ($pk => array ('in', $id ) );
		if(FALSE === $model->where($condition)->save($data)){
			$this->ajaxReturn($val,'修改失败!',0);
        }else{
			$this->ajaxReturn($val,'修改成功!',1);
        }
	}
	
	/**
     +----------------------------------------------------------
	 * 默认删除操作
	 */
	public function delete() {
		//删除指定记录
		$name=$this->getActionName();
		$model = D($name);
		if (! empty ( $model )) {
			$pk = $model->getPk ();
			$id = $_REQUEST [$pk];
			if (isset ( $id )) {
				$condition = array ($pk => array ('in', explode ( ',', $id ) ) );
				$list=$model->where ( $condition )->setField ( 'status', - 1 );
				if ($list!==false) {
					$this->success ('删除成功！' );
				} else {
					$this->error ('删除失败！');
				}
			} else {
				$this->error ( '非法操作' );
			}
		}
	}
	#批量删除
	public function foreverdelete(){
		//删除指定记录
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$pk = $model->getPk();
			$id = $_REQUEST[$pk];
			if (isset($id)){
				$condition = array ($pk => array ('in', explode ( ',', $id ) ) );
				if (false !== $model->where ( $condition )->delete()) {
					//echo $model->getlastsql();
					$this->success ('删除成功！');
				} else {
					$this->error ('删除失败！');
				}
			} else {
				$this->error ( '非法操作' );
			}
		}
	}

	public function clear() {
		//删除指定记录
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			if (false !== $model->where ( 'status=-1' )->delete ()) { // zhanghuihua@msn.com change status=1 to status=-1
				$this->assign("jumpUrl", $this->getReturnUrl () );
				$this->success( L('_DELETE_SUCCESS_'));
			} else {
				$this->error(L('_DELETE_FAIL_'));
			}
		}
	}
	/**
     +----------------------------------------------------------
	 * 默认禁用操作
	 */
	public function forbid(){
		$name=$this->getActionName();
		$model = D ($name);
		$pk = $model->getPk ();
		$id = $_REQUEST [$pk];
		//$this->success($id);exit;
		$condition = array ($pk => array ('in', $id ) );
		$list=$model->forbid ( $condition );
		//$this->success($model->getLastSql());exit;		
		if ($list!==false) {
			$this->assign ( "jumpUrl", $this->getReturnUrl () );
			$this->success ( '状态禁用成功' );
		} else {
			$this->error  (  '状态禁用失败！' );
		}
	}
	#更换状态
	public function toggleStatus($field = 'status'){
		$name=$this->getActionName();
		$model = D($name);
		$pk = $model->getPk ();
		$id = trim($_REQUEST[$pk]);
		$val = trim($_REQUEST['val']);
		$condition = array ($pk => array ('in', $id ) );
		if(!is_numeric($id) or !is_numeric($val)){
			$this->ajaxReturn($val,'必须输入一个数字！',0);		
		}
		if(FALSE === $model->where($condition)->setField($field,$val)){
			$this->ajaxReturn($val,'修改失败!',0);
        }else {
			$this->ajaxReturn($val,'修改成功!',1);
        }
	}
	public function checkPass() {
		$name=$this->getActionName();
		$model = D ($name);
		$pk = $model->getPk ();
		$id = $_GET[$pk];
		$condition = array ($pk => array ('in', $id ) );
		if(false !== $model->checkPass( $condition )) {
			$this->assign ( "jumpUrl", $this->getReturnUrl () );
			$this->success ( '状态批准成功！' );
		} else {
			$this->error  (  '状态批准失败！' );
		}
	}

	public function recycle(){
		$name=$this->getActionName();
		$model = D ($name);
		$pk = $model->getPk ();
		$id = $_GET [$pk];
		$condition = array ($pk => array ('in', $id ) );
		if (false !== $model->recycle ( $condition )) {
			$this->assign("jumpUrl", $this->getReturnUrl());
			$this->success('状态还原成功！');
		} else {
			$this->error('状态还原失败！');
		}
	}

	public function recycleBin($templateFile=false){
		$map = $this->_search ();
		$map ['status'] = - 1;
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display($templateFile);
	}

	/**
     +----------------------------------------------------------
	 * 默认恢复操作
	 */
	function resume() {
		//恢复指定记录
		$name=$this->getActionName();
		$model = D ($name);
		$pk = $model->getPk ();
		$id = $_GET [$pk];
		$condition = array ($pk => array ('in', $id ) );
		if (false !== $model->resume ( $condition )) {
			$this->assign ( "jumpUrl", $this->getReturnUrl () );
			$this->success ( '状态恢复成功！' );
		} else {
			$this->error ( '状态恢复失败！' );
		}
	}


	function saveSort(){
		$seqNoList = $_POST ['seqNoList'];
		if (! empty ( $seqNoList )) {
			//更新数据对象
		$name=$this->getActionName();
		$model = D ($name);
			$col = explode ( ',', $seqNoList );
			//启动事务
			$model->startTrans ();
			foreach ( $col as $val ) {
				$val = explode ( ':', $val );
				$model->id = $val [0];
				$model->sort = $val [1];
				$result = $model->save ();
				if (! $result) {
					break;
				}
			}
			//提交事务
			$model->commit ();
			if ($result!==false) {
				//采用普通方式跳转刷新页面
				$this->success ( '更新成功' );
			} else {
				$this->error ( $model->getError () );
			}
		}
	}
	#空操作
	public function _empty(){ 
		// 把所有城市的操作都解析到city方法 
		$action_name = ACTION_NAME; 	
		$this->error("你的操作:$action_name 不存在！请联系管理员QQ:395276687");
	} 
	#重写ajax返回
    protected function ajaxReturn($data,$message='',$status=1,$type='JSON')
    {
        // 保证AJAX返回后也能保存日志
        if(C('LOG_RECORD')) Log::save();
        $result  =  array();
        $result['status']  =  $status;
        $result['statusCode']  =  $status;	// zhanghuihua@msn.com
        $result['navTabId']  =  $_REQUEST['navTabId'];	// zhanghuihua@msn.com
        $result['message'] =  $message;
        $result['data'] = $data;
        if(empty($type)) $type  =   C('DEFAULT_AJAX_RETURN');
        if(strtoupper($type)=='JSON') {
            // 返回JSON数据格式到客户端 包含状态信息
            header("Content-Type:text/html; charset=utf-8");
			$json_str = json_encode($result);
			if(isset($_REQUEST['jsoncallback'])){//jquery跨域调用
				$json_str = $_REQUEST['jsoncallback'] .'('.$json_str.')';
			}
            exit($json_str);
        }elseif(strtoupper($type)=='XML'){
            // 返回xml格式数据
            header("Content-Type:text/xml; charset=utf-8");
            exit(xml_encode($result));
        }elseif(strtoupper($type)=='EVAL'){
            // 返回可执行的js脚本
            header("Content-Type:text/html; charset=utf-8");
            exit($data);
        }else{
            // TODO 增加其它格式
        }
    }
    /**
     * 设置所有状态
     */
    public function setStatusAll(){
        $M = D($this->getActionName());
        if(isset($_REQUEST['is_best'])){
            $val = trim($_REQUEST['is_best']);
            $reg = $M->where(array('is_best'=>empty($val)?1:0))->save(array('is_best'=>$val));
        }
        if($reg===false){
            $this->error('修改失败！');
        }else{
            $this->success('修改成功');
        }
        return false;
        if(isset($_REQUEST['is_new'])){
            $val = trim($_REQUEST['is_new']);
            $reg = $M->where(array('is_new'=>empty($val)?1:0))->save(array('is_new'=>$val));
        }
        if(isset($_REQUEST['is_hot'])){
            $val = trim($_REQUEST['is_hot']);
            $reg = $M->where(array('is_hot'=>empty($val)?1:0))->save(array('is_hot'=>$val));
        }

    }

}
?>
