<?php
class CouponsAction extends Action{
	public function index(){
		$Coupons = M('Coupons');
		$result = $Coupons->select();
		$this->assign('list',$result);
		$this->display();
	}
	public function addCoupons(){
		$Coupons = M('Coupons');
		if($_POST['submit']){
			$data = array(
						'title' => $_POST['coupon_title'],
						'code' => $_POST['coupon_code'],
						'min_order' => $_POST['min_order_total'],
						'expiry_date' => $_POST['type1_time'],
						'discount_in' => $_POST['discount_in'],
						'applied_on' => $_POST['discount_applied'],
						'discount' => $_POST['coupon_discount'],
						'desc' => $_POST['coupon_des'],
						'create_time' =>time(),
						);
			$result = $Coupons->add($data);
			if($result){
				$this->redirect('/Coupons/index');
			}
		}
		$this->display();
	}
}
?>