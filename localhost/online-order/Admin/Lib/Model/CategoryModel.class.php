<?php
/* 
*	分类模型
*/
class CategoryModel extends CommonModel {
	public static $res = NULL;
	public static $cat_options = NULL;
	public static $cat_info = NULL;
	/*
	*	生成分类树
	*/
	public function showTreeHtml(){
	
	}
	/*
	*	递归获取分类树
	*/
	public function getCat($pid, &$arr="",$type = 1) {
		if(empty($arr)) {
			$arr = array();
		}
		$list = $this->where('parent_id = '.$pid.'type='.$type)->select();
		foreach($list as $row){
			if(!empty($row)) {
				$arr[] = $row;
				$this->getCat($row['cat_id'], $arr);
			}
		}
		return $arr;
	}
	/**
	 * 获得指定分类下的子分类的数组
	 *
	 * @access  public
	 * @param   int     $cat_id     分类的ID
	 * @param   int     $selected   当前选中分类的ID
	 * @param   boolean $re_type    返回的类型: 值为真时返回下拉列表,否则返回数组
	 * @param   int     $level      限定返回的级数。为0时返回所有级数
	 * @param   int     $type       分类的类型，1为图片分类，2为主题分类,3为文章分类,4为图片看看分类，5为鼠标指针,6为屏保,7为文件夹图标,8开机画面
	 * @param   int     $is_show_all 如果为true显示所有分类，如果为false隐藏不可见分类。
	 * @return  mix
	 */
	public function cat_list($cat_id = 0, $selected = 0, $re_type = true, $level = 0, $type=1,$is_show_all = true){
		if (self::$res === NULL){
			$data = S('cat_pid_releate'.$type);//读取缓存数据
			if ($data === false){
				$sql = "SELECT c.cat_id, c.cat_name,c.english_name, c.measure_unit, c.parent_id, c.is_show, c.show_in_nav, c.sort_order,COUNT(s.cat_id) AS has_children ,c.type ".
					'FROM ' .'bizi_category'. " AS c ".
					"LEFT JOIN " .('bizi_category'). " AS s ON s.parent_id=c.cat_id ".
					"WHERE c.type=$type ".
					"GROUP BY c.cat_id ".
					'ORDER BY c.parent_id, c.sort_order DESC';
				self::$res = $this->query($sql);

				if($type == 1){//查询图片分类里面的图片组数量
					$sql = "SELECT cat_ids, COUNT(*) AS content_num " .
						" FROM " . ('bizi_node') .
						" GROUP BY cat_ids";
					$res1 = $this->query($sql);
				}elseif($type == 2){//主题分类里面的主题数量
					$sql = "SELECT cat_ids, COUNT(*) AS content_num " .
						" FROM " . ('bizi_theme') .
						" GROUP BY cat_ids";
					$res1 = $this->query($sql);
				}elseif($type == 3){//主题分类里面的主题数量
					$sql = "SELECT cat_ids, COUNT(*) AS content_num " .
						" FROM " . ('bizi_article') .
						" GROUP BY cat_ids";
					$res1 = $this->query($sql);
				}
				
				$newres = array();
				foreach($res1 as $var){
					//$newres[$var['type']] = $var['content_num'];
					$arr = explode(',',$var['cat_ids']);
					foreach($arr as $v){
						$newres[$v] += $var['content_num'];
					}
				}
				//每个分类下面的产品数量
				foreach(self::$res as $k=>$v)
				{
					self::$res[$k]['content_num'] = !empty($newres[$v['cat_id']]) ? $newres[$v['cat_id']] : 0;
				}
				//如果数组过大，不采用静态缓存方式
				if (count(self::$res) <= 1000){
					S('cat_pid_releate'.$type, self::$res,C('CACHE_TIME'));//缓存一分钟
				}
			}
			else
			{
				self::$res = $data;
			}
		}

		if (empty(self::$res))
		{
			return $re_type ? '' : array();
		}
	
		$options = $this->cat_options($cat_id, self::$res,$type); // 获得指定分类下的子分类的数组
	
		$children_level = 99999; //大于这个分类的将被删除
		if ($is_show_all == false){
			foreach ($options as $key => $val){
				if ($val['level'] > $children_level){
					unset($options[$key]);
				}else{
					if($val['is_show'] == 0){
						unset($options[$key]);
						if ($children_level > $val['level']){
							$children_level = $val['level']; //标记一下，这样子分类也能删除
						}
					}else{
						$children_level = 99999; //恢复初始值
					}
				}
			}
		}
	
		/* 截取到指定的缩减级别 */
		if($level > 0){
			if ($cat_id == 0){
				$end_level = $level;
			}else{
				$first_item = reset($options); // 获取第一个元素
				$end_level  = $first_item['level'] + $level;
			}
			/* 保留level小于end_level的部分 */
			foreach ($options AS $key => $val){
				if ($val['level'] >= $end_level){
					unset($options[$key]);
				}
			}
		}
	
		if ($re_type == true){//为真时返回下拉选择,否则返回数组
			$select = '';
			foreach ($options AS $var){
				$select .= '<option value="' . $var['cat_id'] . '" ';
				$select .= ($selected == $var['cat_id']) ? "selected='ture'" : '';
				$select .= '>';
				if ($var['level'] > 0){
					$select .= str_repeat('&nbsp;', $var['level'] * 4);
				}
				$select .= htmlspecialchars(addslashes($var['cat_name']), ENT_QUOTES) . '</option>';
			}
			return $select;
		}else{
			return $options;
		}
	}
	
	
	/**
	 * 过滤和排序所有分类，返回一个带有缩进级别的数组
	 *
	 * @access  private
	 * @param   int     $cat_id     上级分类ID
	 * @param   array   $arr        含有所有分类的数组
	 * @param   int     $level      级别
	 * @return  void
	 */
	public function cat_options($spec_cat_id, $arr,$type = 1){
		if (isset(self::$cat_options[$spec_cat_id])){
			return self::$cat_options[$spec_cat_id];
		}

		if (!isset(self::$cat_options[0])){
			$level = $last_cat_id = 0;
			$options = $cat_id_array = $level_array = array();
			$data = S('cat_option_static'.$type);//读取缓存
			if ($data === false){
				while (!empty($arr)){
					foreach ($arr AS $key => $value){
						$cat_id = $value['cat_id'];
						if ($level == 0 && $last_cat_id == 0){
							if ($value['parent_id'] > 0){
								break;
							}
							$options[$cat_id]          = $value;
							$options[$cat_id]['level'] = $level;
							$options[$cat_id]['id']    = $cat_id;
							$options[$cat_id]['name']  = $value['cat_name'];
							unset($arr[$key]);
	
							if ($value['has_children'] == 0){
								continue;
							}
							$last_cat_id  = $cat_id;
							$cat_id_array = array($cat_id);
							$level_array[$last_cat_id] = ++$level;
							continue;
						}
	
						if ($value['parent_id'] == $last_cat_id){
							$options[$cat_id]          = $value;
							$options[$cat_id]['level'] = $level;
							$options[$cat_id]['id']    = $cat_id;
							$options[$cat_id]['name']  = $value['cat_name'];
							unset($arr[$key]);
	
							if ($value['has_children'] > 0){
								if (end($cat_id_array) != $last_cat_id){
									$cat_id_array[] = $last_cat_id;
								}
								$last_cat_id    = $cat_id;
								$cat_id_array[] = $cat_id;
								$level_array[$last_cat_id] = ++$level;
							}
						}
						elseif ($value['parent_id'] > $last_cat_id){
							break;
						}
					}
	
					$count = count($cat_id_array);
					if ($count > 1){
						$last_cat_id = array_pop($cat_id_array);
					}elseif ($count == 1){
						if ($last_cat_id != end($cat_id_array)){
							$last_cat_id = end($cat_id_array);
						}else{
							$level = 0;
							$last_cat_id = 0;
							$cat_id_array = array();
							continue;
						}
					}
	
					if ($last_cat_id && isset($level_array[$last_cat_id])){
						$level = $level_array[$last_cat_id];
					}else{
						$level = 0;
					}
				}
				//如果数组过大，不采用静态缓存方式
				if (count($options) <= 2000){
					S('cat_option_static'.$type, $options,C('CACHE_TIME'));
				}
			}else{
				$options = $data;
			}
			self::$cat_options[0] = $options;
		}else{
			$options = self::$cat_options[0];
		}
	
		if (!$spec_cat_id){
			return $options;
		}else{
			if (empty($options[$spec_cat_id])){
				return array();
			}
	
			$spec_cat_id_level = $options[$spec_cat_id]['level'];
	
			foreach ($options AS $key => $value){
				if ($key != $spec_cat_id){
					unset($options[$key]);
				}else{
					break;
				}
			}
	
			$spec_cat_id_array = array();
			foreach ($options AS $key => $value)
			{
				if (($spec_cat_id_level == $value['level'] && $value['cat_id'] != $spec_cat_id) ||
					($spec_cat_id_level > $value['level']))
				{
					break;
				}
				else
				{
					$spec_cat_id_array[$key] = $value;
				}
			}
			self::$cat_options[$spec_cat_id] = $spec_cat_id_array;
	
			return $spec_cat_id_array;
		}
	}
	
	
	/*
	*	递归删除分类目录树
	*/
	/*public function delCat($cid) {
		//获得下一层分类
		$list = $this->where('parent_id = '.$cid)->select();
		foreach($list as $row){
			if(!empty($row)) {
				$this->delCat($row['parent_id']);
			}
		}
		//删除本层分类
		$this->where('parent_id = '.$cid.'type='.$type)->delete();
		return $list;
	}*/
	
	public function jTree($parent_id = 0,$cat_ids = '',$type=1){
		if (self::$cat_info === NULL){
			self::$cat_info = $this->cat_list(0,0,false,0,$type);
		}
		if($parent_id == 0){
			$str = '<ul class="tree treeCheck expand" oncheck="">';
		}else{
			$str = '<ul>';
		}
		if(!is_array($cat_ids)){
			$cat_ids = explode(',',$cat_ids);
		}
		$is_empty = true;
		foreach(self::$cat_info as $var){
			if($var['parent_id'] == $parent_id){
				$str .= '<li><a tname="cat_ids[]" tvalue="'.$var['cat_id'].'" '.(in_array($var['cat_id'],$cat_ids)?'checked="true"':'').'>'.$var['cat_name'].'</a>';
				$str.= $this->jTree($var['cat_id'],$cat_ids,$type);
				$str.='</li>';
				$is_empty = false;
			}
		}
		if($is_empty){return '';}
		$str.='</ul>';
		return $str;
	}
	/*
	*	清楚指定类型的分类缓存
	*/
	public function clear_cache($type){
		S('cat_pid_releate'.$type,NULL);
		S('cat_option_static'.$type,NULL);
		self::$res = NULL;
		self::$cat_options = NULL;
		self::$cat_info = NULL;
	}
}
?>