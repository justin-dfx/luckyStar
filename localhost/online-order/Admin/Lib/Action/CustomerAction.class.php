<?php
class CustomerAction extends CommonAction {
	public function index()
	{
		$Member = M('Member');
		$Address = M('MemberAddress');
		$Order  = M('Billhead');
		$result = $Order->where(array('restaurant_id' => $_SESSION['restaurant_id']))->select();
		foreach($result AS $k => $v){
			$member_id .= $v['bh_customer_id'].",";
		}//echo $member_id;
		$Customers = $Address->field('on_member.account,on_member.email,on_member_address.*')->join('on_member ON on_member_address.member_id=on_member.id')->where(array('member_id' => array('in',$member_id)))->select();//print_r($Customers);exit;
		foreach($Customers AS $key => $val){
				$name = explode(' ',$Customers[$key]['name']);//print_r($name);exit;
				$Customers[$key]['first_name'] = $name[0];
				$Customers[$key]['last_name'] = $name[1];
				$address = explode('-',$Customers[$key]['address']);//print_r($address);exit;
				$info1 = explode(' ',$address[0]);
				$info2 = explode(' ',$address[1]);//print_r($info2);exit;
				$Customers[$key]['address'] = $info2[2];
				$Customers[$key]['city'] = $info1[1];
				$Customers[$key]['status'] = $info1[0];
			
		}
		//print_r($Customers);
		$this->assign('list',$Customers);
		$this->display();
	}
}
?>