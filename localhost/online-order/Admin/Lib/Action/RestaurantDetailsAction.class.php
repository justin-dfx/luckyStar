<?php
// 餐馆会员详情模块
class RestaurantDetailsAction extends CommonAction {
	public function _before_add(){
		$restaurant_id = $_REQUEST['restaurant_id'];
		$this->assign('restaurant_id',$restaurant_id);
	}
	/*public function _before_insert(){
		$tip = explode(',',$_POST['tip']);
		foreach($tip as $v){
			if(!is_numeric($v)){
				$this->error('Tip Input error!');	
			}	
		}
		if($_POST['is_delivery'] == '1'){
			$dhours = array(
				'Monday' 	=> $_POST['mon_dstart'].'-'.$_POST['mon_dend'],
				'Tuesday' 	=> $_POST['tues_dstart'].'-'.$_POST['tues_dend'],
				'Wednesday' => $_POST['wed_dstart'].'-'.$_POST['wed_dend'],
				'Thursday' 	=> $_POST['thur_dstart'].'-'.$_POST['thur_dend'],
				'Friday' 	=> $_POST['fri_dstart'].'-'.$_POST['fri_dend'],
				'Saturday' 	=> $_POST['sat_dstart'].'-'.$_POST['sat_dend'],
				'Sunday' 	=> $_POST['sun_dstart'].'-'.$_POST['sun_dend'],
			);
			$_POST['deliveryhours'] = json_encode($dhours);
		}
		if($_POST['is_pickup'] == '1'){
			$phours = array(
				'Monday' 	=> $_POST['mon_pstart'].'-'.$_POST['mon_pend'],
				'Tuesday' 	=> $_POST['tues_pstart'].'-'.$_POST['tues_pend'],
				'Wednesday' => $_POST['wed_pstart'].'-'.$_POST['wed_pend'],
				'Thursday' 	=> $_POST['thur_pstart'].'-'.$_POST['thur_pend'],
				'Friday' 	=> $_POST['fri_pstart'].'-'.$_POST['fri_pend'],
				'Saturday' 	=> $_POST['sat_pstart'].'-'.$_POST['sat_pend'],
				'Sunday' 	=> $_POST['sun_pstart'].'-'.$_POST['sun_pend'],
			);	
			$_POST['pickuphours'] = json_encode($phours);
		}
		
	}
	public function edit(){
		$restaurant_id = $_REQUEST['restaurant_id'];
		$RestaurantDetails = M('RestaurantDetails');
		$list = $RestaurantDetails->where(array('restaurant_id'=>$restaurant_id))->find();
		if(!$list){
			$this->error('Please increase the Restaurant details.');	
		}
		if($list['is_delivery'] == '1'){
			$deliveryhours = json_decode($list['deliveryhours'],true);
			foreach($deliveryhours as $k=>$v){
				$dhours[$k] = explode('-',$v);
			}
		}
		if($list['is_pickup'] == '1'){
			$pickuphours = json_decode($list['pickuphours'],true);
			foreach($pickuphours as $key=>$val){
				$phours[$key] = explode('-',$val);
			}
		}
		$this->assign('phours',$phours);
		$this->assign('dhours',$dhours);
		$this->assign('vo',$list);
		$this->display();
	}
	
	public function _before_update(){
		if($_POST['is_delivery'] == '1'){
				$dhours = array(
					'Monday' 	=> $_POST['mon_dstart'].'-'.$_POST['mon_dend'],
					'Tuesday' 	=> $_POST['tues_dstart'].'-'.$_POST['tues_dend'],
					'Wednesday' => $_POST['wed_dstart'].'-'.$_POST['wed_dend'],
					'Thursday' 	=> $_POST['thur_dstart'].'-'.$_POST['thur_dend'],
					'Friday' 	=> $_POST['fri_dstart'].'-'.$_POST['fri_dend'],
					'Saturday' 	=> $_POST['sat_dstart'].'-'.$_POST['sat_dend'],
					'Sunday' 	=> $_POST['sun_dstart'].'-'.$_POST['sun_dend'],
				);
				$_POST['deliveryhours'] = json_encode($dhours);
			}
		if($_POST['is_pickup'] == '1'){
			$phours = array(
				'Monday' 	=> $_POST['mon_pstart'].'-'.$_POST['mon_pend'],
				'Tuesday' 	=> $_POST['tues_pstart'].'-'.$_POST['tues_pend'],
				'Wednesday' => $_POST['wed_pstart'].'-'.$_POST['wed_pend'],
				'Thursday' 	=> $_POST['thur_pstart'].'-'.$_POST['thur_pend'],
				'Friday' 	=> $_POST['fri_pstart'].'-'.$_POST['fri_pend'],
				'Saturday' 	=> $_POST['sat_pstart'].'-'.$_POST['sat_pend'],
				'Sunday' 	=> $_POST['sun_pstart'].'-'.$_POST['sun_pend'],
			);	
			$_POST['pickuphours'] = json_encode($phours);
		}
	}*/
	public function index()
	{
		$RestaurantMember = M('restaurant_member');
		$_SESSION['restaurant_id'] = $_GET['restaurant_id'];
		if($_SESSION['restaurant_id'])
		{
			$info = $RestaurantMember->where(array('id' => $_SESSION['restaurant_id']))->find();
			if($_POST['btnSave'])
			{
				$data['email']					=	$_POST['email'];
				$data['nickname']				=	$_POST['catname'];
				$data['phone']					=	$_POST['phone'];
				$data['resfax']					=	$_POST['fax'];
				$data['zip']					=	$_POST['rest_zip'];
				$data['address']				=	$_POST['rest_address'];
				$data['remark']					=	$_POST['meta_description'];
				$data['city']					=	$_POST['rest_city'];
				$data['state']					=	$_POST['rest_state'];
				$data['lng']					=	$_POST['lng'];
				$data['lat']					=	$_POST['lat'];
				$data['delivery_radius']		=	$_POST['delivery_radius'];
				$data['order_minimum']			=	$_POST['order_minimum'];
				$data['tax']					=	$_POST['tax_percent'];
				$data['delivery_charges']		=	$_POST['delivery_charges'];
				$data['announcements']			=	$_POST['rest_announcements'];
				$data['announcements_status']	=	$_POST['announcements_status'];
				$data['business_status']		=	$_POST['rest_open_close'];
				$data['facebook_link']			=	$_POST['facebookLink'];
				$data['keywords']			=	$_POST['meta_keywords'];
				$data['update_time']=	time();
				if(isset($_FILES['image']) && !empty($_FILES['image'])&& $_FILES['image']['error']==0)
				{
					$data['logo']			=	$this->uploadfile();	
				}else
				{
					$data['logo']			=	$_POST['logo'];
				}

				if($_POST['restaurant_id'])
				{
					$result = $RestaurantMember->where(array('id' => $_POST['restaurant_id']))->save($data);
					if($result)
					{
						$this->redirect('/Menus/index');
					}
				}
				
			}
		}
		$this->assign('info',$info);
		$this->assign('restaurant_id',$_SESSION['restaurant_id']);
		$this->display();
	}

	public function openDate()
	{
		$Opentime = M('Opentime');
		if($_POST['update'])
		{
			$data['restaurant_id'] = $_POST['restaurant_id'];
			$data['mon'] = $_POST['open_hr'][0].":".$_POST['open_min'][0]." - ".$_POST['close_hr'][0].":".$_POST['close_min'][0];
			$data['tue'] = $_POST['open_hr'][1].":".$_POST['open_min'][1]." - ".$_POST['close_hr'][1].":".$_POST['close_min'][1];
			$data['wed'] = $_POST['open_hr'][2].":".$_POST['open_min'][2]." - ".$_POST['close_hr'][2].":".$_POST['close_min'][2];
			$data['thu'] = $_POST['open_hr'][3].":".$_POST['open_min'][3]." - ".$_POST['close_hr'][3].":".$_POST['close_min'][3];
			$data['fri'] = $_POST['open_hr'][4].":".$_POST['open_min'][4]." - ".$_POST['close_hr'][4].":".$_POST['close_min'][4];
			$data['sat'] = $_POST['open_hr'][5].":".$_POST['open_min'][5]." - ".$_POST['close_hr'][5].":".$_POST['close_min'][5];
			$data['sun'] = $_POST['open_hr'][6].":".$_POST['open_min'][6]." - ".$_POST['close_hr'][6].":".$_POST['close_min'][6];
			$data['update_time'] = time();

			if($_POST['time_id'])
			{
				$result = $Opentime->where(array('id' => $_POST['time_id']))->save($data);
			}else
			{
				$result = $Opentime->add($data);
			}
			

			
			if($result)
			{
				$info = $Opentime->where(array('restaurant_id' => $_SESSION['restaurant_id']))->find();
				$arr_mon = explode(' - ',$info['mon']);
				$arr_tue = explode(' - ',$info['tue']); 
				$arr_wed = explode(' - ',$info['wed']); 
				$arr_thu = explode(' - ',$info['thu']); 
				$arr_fri = explode(' - ',$info['fri']); 
				$arr_sat = explode(' - ',$info['sat']); 
				$arr_sun = explode(' - ',$info['sun']); 
				$times['mon_open'] = explode(':',$arr_mon[0]);
				$times['mon_close'] = explode(':',$arr_mon[1]);
				$times['tue_open'] = explode(':',$arr_tue[0]);
				$times['tue_close'] = explode(':',$arr_tue[1]);
				$times['wed_open'] = explode(':',$arr_wed[0]);
				$times['wed_close'] = explode(':',$arr_wed[1]);
				$times['thu_open'] = explode(':',$arr_thu[0]);
				$times['thu_close'] = explode(':',$arr_thu[1]);
				$times['fri_open'] = explode(':',$arr_fri[0]);
				$times['fri_close'] = explode(':',$arr_fri[1]);
				$times['sat_open'] = explode(':',$arr_sat[0]);
				$times['sat_close'] = explode(':',$arr_sat[1]);
				$times['sun_open'] = explode(':',$arr_sun[0]);
				$times['sun_close'] = explode(':',$arr_sun[1]);
			}
		}

		$info = $Opentime->where(array('restaurant_id' => $_SESSION['restaurant_id']))->find();
				$arr_mon = explode(' - ',$info['mon']);
				$arr_tue = explode(' - ',$info['tue']); 
				$arr_wed = explode(' - ',$info['wed']); 
				$arr_thu = explode(' - ',$info['thu']); 
				$arr_fri = explode(' - ',$info['fri']); 
				$arr_sat = explode(' - ',$info['sat']); 
				$arr_sun = explode(' - ',$info['sun']); 
				$times['mon_open'] = explode(':',$arr_mon[0]);
				$times['mon_close'] = explode(':',$arr_mon[1]);
				$times['tue_open'] = explode(':',$arr_tue[0]);
				$times['tue_close'] = explode(':',$arr_tue[1]);
				$times['wed_open'] = explode(':',$arr_wed[0]);
				$times['wed_close'] = explode(':',$arr_wed[1]);
				$times['thu_open'] = explode(':',$arr_thu[0]);
				$times['thu_close'] = explode(':',$arr_thu[1]);
				$times['fri_open'] = explode(':',$arr_fri[0]);
				$times['fri_close'] = explode(':',$arr_fri[1]);
				$times['sat_open'] = explode(':',$arr_sat[0]);
				$times['sat_close'] = explode(':',$arr_sat[1]);
				$times['sun_open'] = explode(':',$arr_sun[0]);
				$times['sun_close'] = explode(':',$arr_sun[1]);

		$this->assign('times',$times);
		$this->assign('info',$info);
		$this->display();
	}

	public function uploadfile(){
		import('@.ORG.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 2097152 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  'Public/Uploads/Logo/'.date('Ymd',time()).'/';// 设置附件上传目录
		$upload->saveRule = 'uniqid';
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功
			$info = $upload->getUploadFileInfo();
			$_POST['image'] = '/'.$info[0]['savepath'].$info[0]['savename'];
			return $_POST['image'];
		}	
	}
}

?>