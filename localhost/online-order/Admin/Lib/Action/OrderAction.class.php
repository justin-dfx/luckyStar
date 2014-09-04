<?php
// 订单模块
class OrderAction extends CommonAction {
	
	/*public function _search(){
		if(!empty($_POST['order_sn'])){
			$map['order_sn'] = array('like','%'.$_POST['order_sn'].'%');
		}	
		return $map;
	}
	public function view(){
		$id = $_REQUEST['id'];
		$Order = M('Order');
		$ShoppingCart = M('ShoppingCart');
		$list = $Order->where(array('id'=>$id))->select();
		$cart_ids = explode(',',$list[0]['cart_ids']);
		$menu_list = $ShoppingCart->where(array('id'=>array('in',$list[0]['cart_ids'])))->select();
		foreach($menu_list as $key=>$val){
			$items = json_decode($val['items'],true);
			foreach($items as $k=>$v){
				$menu_list[$key]['item'] .= $k.'('.$v.')'.' ';
			}
		}
		$this->assign('menu_list',$menu_list);
		$this->assign('list',$list);
		$this->display();	
	}
	public function res_view(){
		$id = $_REQUEST['id'];
		$Order = M('Order');
		$ShoppingCart = M('ShoppingCart');
		$list = $Order->where(array('id'=>$id))->find();
		$this->assign('list',$list);
		$this->display();	
	}
	public function changeStatus(){
		$id = $_REQUEST['id'];
		$Order = M('Order');
		$status = $Order->where(array('id'=>$id))->getField('status');
		$type = array(
			1  => 'delivery_time',
			2  => 'complete_time'
		);
		if($status != '0'){
			$result = $Order->where(array('id'=>$id))->save(array('status'=>($status+1),$type[$status]=>time()));
			if($result){
			$this->success('操作成功');	
			}else{
				$this->success('操作失败');	
			}
		}
		
	}
	public function cancel(){
		$id = $_REQUEST['id'];
		$Order = M('Order');
		$result = $Order->where(array('id'=>$id))->save(array('status'=>0,'cancel_time'=>time()));
		if($result){
			$this->success('取消成功');	
		}else{
			$this->success('取消失败');	
		}	
	}*/

	public function index()
	{
		$Order = M('Billhead');
		$Order_count = $Order->where(array('restaurant_id' => $_SESSION['restaurant_id']))->count();
		if($_GET['status'] == "0")
		{
			$list = $Order->field('on_member.account,on_member.email,on_member.telephone,on_member.address,on_billhead.id,on_billhead.restaurant_id,on_billhead.bh_no,on_billhead.bh_type,on_billhead.bh_status,on_billhead.bh_create_time')->where(array('on_billhead.restaurant_id' => $_SESSION['restaurant_id'],'on_billhead.bh_status' => 3,'on_billhead.bh_status' => 0))->join('on_member ON on_billhead.bh_customer_id = on_member.id')->order('id desc')->select();
			foreach($list AS $key => $row)
			{
				$list[$key]['bh_create_time'] = date('d/m/Y',$list[$key]['bh_create_time']);
				if($list[$key]['bh_type'] == 3)
				{
					$list[$key]['bh_type'] = "Dine In";
				}else if($list[$key]['bh_type'] == 1)
				{
					$list[$key]['bh_type'] = "Delivery";
				}else if($list[$key]['bh_type'] == 2)
				{
					$list[$key]['bh_type'] = "Carry Out";
				}
			}
		}else if($_GET['status'] == "6")
		{
			$list = $Order->field('on_member.account,on_member.email,on_member.telephone,on_member.address,on_billhead.id,on_billhead.restaurant_id,on_billhead.bh_no,on_billhead.bh_type,on_billhead.bh_status,on_billhead.bh_create_time')->where(array('on_billhead.restaurant_id' => $_SESSION['restaurant_id'],'on_billhead.bh_status' => 3,'on_billhead.bh_status' => 6))->join('on_member ON on_billhead.bh_customer_id = on_member.id')->order('id desc')->select();
			foreach($list AS $key => $row)
			{
				$list[$key]['bh_create_time'] = date('d/m/Y',$list[$key]['bh_create_time']);
				if($list[$key]['bh_type'] == 3)
				{
					$list[$key]['bh_type'] = "Dine In";
				}else if($list[$key]['bh_type'] == 1)
				{
					$list[$key]['bh_type'] = "Delivery";
				}else if($list[$key]['bh_type'] == 2)
				{
					$list[$key]['bh_type'] = "Carry Out";
				}
			}
		}else
		{
			$list = $Order->field('on_member.account,on_member.email,on_member.telephone,on_member.address,on_billhead.id,on_billhead.restaurant_id,on_billhead.bh_no,on_billhead.bh_type,on_billhead.bh_status,on_billhead.bh_create_time')->where(array('restaurant_id' => $_SESSION['restaurant_id'],'bh_status' => 3))->join('on_member ON on_billhead.bh_customer_id = on_member.id')->select();
			foreach($list AS $key => $row)
			{
				$list[$key]['bh_create_time'] = date('d/m/Y',$list[$key]['bh_create_time']);
				if($list[$key]['bh_type'] == 3)
				{
					$list[$key]['bh_type'] = "Dine In";
				}else if($list[$key]['bh_type'] == 1)
				{
					$list[$key]['bh_type'] = "Delivery";
				}else if($list[$key]['bh_type'] == 2)
				{
					$list[$key]['bh_type'] = "Carry Out";
				}
			}
		}
		//print_r($list);
		$this->assign('list',$list);
		$this->assign('order_count',$Order_count);

		$this->display();
	}
	public function order_Info()
	{
		$Order = M('Billhead');
		$Billitem = M('Billitem');
		$Order_id = $_GET['order_id'];
		if($Order_id)
		{
			$info = $Order->field('on_member.account,on_member.email,on_member.telephone,on_member.address,on_billhead.id,on_billhead.restaurant_id,on_billhead.bh_no,on_billhead.bh_type,on_billhead.bh_status,on_billhead.bh_subtotal,on_billhead.bh_discount,on_billhead.bh_taxamt,on_billhead.bh_delivery,on_billhead.bh_tips,on_billhead.bh_total,on_billhead.bh_payment,on_billhead.bh_address,on_billhead.bh_create_time,on_billitem.bh_id,on_billitem.item_id,on_billitem.bi_identifier,on_billitem.bi_price,on_billnote.bn_note,on_billnote.bh_id,on_restaurant_member.nickname,on_item.item_name,on_billitem.bi_quantity,on_item.price,on_billitem.bi_amount')->join(array('on_billitem ON on_billhead.id = on_billitem.bh_id','on_member ON on_billhead.bh_customer_id = on_member.id','on_billnote ON on_billhead.id = on_billnote.bh_id','on_billattribute ON on_billhead.id = on_billattribute.bh_id','on_restaurant_member ON on_billhead.restaurant_id = on_restaurant_member.id','on_item ON on_billitem.item_id = on_item.id'))->where(array('on_billhead.id' => $Order_id))->find();
			$billitemList = $Billitem->where(array('restaurant_id' =>$_SESSION['restaurant_id'],'bh_id' => $info['id']))->select();
			$info['item_list'] = $billitemList;
			//print_r($info);
		}
		$this->assign('info',$info);
		$this->display();
	}

	public function confirm_Order()
	{
		$Order = M('Billhead');
		$Order_id = $_GET['order_id'];
		if($Order_id)
		{
			$data['bh_status'] = "3";
			$result = $Order->where(array('id' => $Order_id))->save($data);
			if($result)
			{
				$this->redirect('/Order/index');
			}
		}
	}
	public function delete_Order()
	{
		$Order = M('Billhead');
		$Order_id = $_GET['order_id'];
		if($Order_id)
		{
			$result = $Order->where(array('id' => $Order_id))->delete();
			if($result)
			{
				$this->redirect('/Order/index');
			}
		}
	}
	
}
?>