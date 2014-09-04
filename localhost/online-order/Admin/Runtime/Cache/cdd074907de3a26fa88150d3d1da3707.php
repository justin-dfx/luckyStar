<?php if (!defined('THINK_PATH')) exit();?>﻿

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>easywayordering</title>

<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery-ui-1.8.22.custom.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/Togle.js"></script>
<link href="__PUBLIC__/css/adminMain.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/south-street/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />


<!-- GOOGLE API KEY FOR DREAM HOST:  AIzaSyCkRkSd4hQornJOYjYMoHqi3-Wv4hVOOgg-->
<!-- GOOGLE API KEY FOR LOCAL PROJECT:  ABQIAAAAPpaOjFQ_miNP74G3g3O7oBTTwBGlz0OqYPu6tmNrU0ToxRrT5hQhlPr8PLUNIxb0D5FrOa5lJ1tp6w-->
<!-- <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBT2sOPbIDLELZVjk6vPcGs87xqabq2jcs&sensor=false" type="text/javascript"></script>
 --><!--<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBT2sOPbIDLELZVjk6vPcGs87xqabq2jcs" type="text/javascript"></script> -->
</script>
<script type="text/javascript" language="javascript">
	function initialize() {
		geocoder = new google.maps.Geocoder();
	}
</script>

</head>

﻿<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<body>
<div id="maincontainer">
	<div id="header">
		<div id="top">
			<div id="top_left"></div>
			<div id="top_right"></div>
		</div><!--End top Div-->
    </div><!--End header Div-->        
    <div id="text_holder">
        <div id="logo_area">
        	<div id="logo"><img src="__PUBLIC__/Images/man_img.png" width="57" height="74" /></div>
        	<div id="logo_text">ADMINISTRATION PANEL</div>
        	<div id="login_text"><strong>Welcome</strong>&nbsp;&nbsp;restaurateur, <?php echo ($_SESSION['']); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="__APP__/Public/logout/">Log out</a></div>
        	<br style="clear:both" />
        </div>                
        <!--End logo_area Div-->
        <div id="page_content">
        	<div id="navigation_links">
        		<div id="navigation">
        			<div class="links selected"><a href="__APP__/Index" >Restaurants</a></div>
        			<div class="links not"><a href="__APP__/Public/changePwd" >Change Password</a></div>
                    <div class="links not"><a href="__APP__/Public/addRestaurant" >Create New Restaurant</a></div>
        			<!-- <div class="links not"><a href="apikey.html" >API Key</a></div>
                    <div class="links not"><a href="apikey.html" >Restaurant Review </a></div> -->
        			<br style="clear:both" />
        		</div>
        		<!--End navigation Div-->
            </div>
            <!--End navigation_links Div-->
            <div id="tab_items">
            	<ul>
            		<li><a href="__APP__/Index/index" class="selected_red">Restaurants Listing</a></li>
            	</ul>
            </div>


                        <!--End navigation Div-->
            </div><!--End navigation_links Div-->
            
<div id="BodyContainer">
    
    
 
    
    <div style="padding-bottom:10px;text-align:center">
      <img style="width:1085px; height:90px;" src="__PUBLIC__/Images/img_856_cat_header.jpg" border="0" />
  </div>
 <div id="navigation_links">
                           <div id="navigation">
                            
                            <div class="links "><a href="__APP__/RestaurantDetails/index/restaurant_id/<?php echo ($_SESSION['restaurant_id']); ?>" >Restaurants(<?php echo ($_SESSION['restaurant_count']); ?>)</a></div>
                            <div class="links "><a href="__APP__/Order/index/restaurant_id/<?php echo ($_SESSION['restaurant_id']); ?>" class="">Orders(<?php echo ($_SESSION['order_count']); ?>)</a></div>
                            <div class="links "><a href="__APP__/Customer/index" class="">Customers(0)</a></div>
                            <div class="links "><a href="__APP__" class="">Coupons</a></div>
                            <div class="links selected"><a href="__APP__/Menus/index/restaurant_id/<?php echo ($_SESSION['restaurant_id']); ?>"class="">Menus</a></div>
                            <!-- <div class="links "><a href="?mod=mailing_list"class="">Mailing List</a></div>
                            <div class="links "><a href="analytics.html"class="">Analytics</a></div> -->
                            <br style="clear:both" />
                          </div>
                        </div>
  
  <div id="tab_items">
    <ul>
      <li> <a href="__APP__/Order/index/restaurant_id/<?php echo ($_SESSION['restaurant_id']); ?>/status/3" class="">View Approved Orders</a> </li>
      |
      <li> <a href="__APP__/Order/index/restaurant_id/<?php echo ($_SESSION['restaurant_id']); ?>/status/0" class="">New Orders</a> </li>
      |
      <!-- <li> <a href="?mod=order&item=report&cid=856" class="">Restaurant Order Report</a> </li> -->
      <li>
                <a href="__APP__/Order/index/restaurant_id/<?php echo ($_SESSION['restaurant_id']); ?>/status/6" >Refund Orders</a>
              </li>
    </ul>
  </div>
   <div id="main_heading">VIEW EXISTING ORDERS </div>
<script language="JavaScript">
function DeleteOrder(OrdID){

alert("Are You sure delete this Order");

}
function showPopReport(OrdID){

window.open("admin_contents/orders/admin_order_report.php?OrderID="+OrdID,"Report","width=1100, height=700, top=0, left=100, toolbar=0, menubar=0, location=0, status=1, scrollbars=1, resizable=0,titlebar=0");
}

function updateOrder(id){
		
		window.location.href="?mod=order&item=orderedit&OrderID="+id;	
	}

</script>
<div class="form_outer">
   <table width="750" border="0" cellpadding="4" cellspacing="0">
       
        <tr> 
          <td><form name="form1" method="post" action="" enctype="multipart/form-data" >
          <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr> 
                  <td width="73" colspan="2" class="style3"><strong>Customer Information:</strong></td>
                  <td width="24%" class="style1" ><?php if($info['bh_status'] == '0'): ?><a href="__APP__/Order/confirm_Order/order_id/<?php echo ($info["id"]); ?>">Confirm</a> |<?php endif; ?> <a href="__APP__/Order/delete_Order/order_id/<?php echo ($info["id"]); ?>" onClick="return confirm('Are you sure you want to delete this order?')">Delete</a></td>
                  <td width="3%">&nbsp;</td>
                </tr>
                <tr> 
               
                  <td colspan="3"><strong>Customer Name:</strong><?php echo ($info["account"]); ?></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="3"><strong>Address:</strong>  <?php echo ($info["address"]); ?> </td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="3"><strong>Phone: </strong><?php echo ($info["telephone"]); ?></td>
                  <td>&nbsp;</td>
                </tr>
                                <tr> 
                  <td colspan="3"><strong>Delivery Address:</strong> <?php echo ($info["bh_address"]); ?> </td>
                  <td>&nbsp;</td>
                </tr>
                
                <tr> 
                  <td colspan="3" class="style1"><HR width="100%" noShade SIZE=1></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" class="style3"><strong>Order Information:</strong></td>
                  <td>&nbsp;</td>
                </tr>
                
                <tr>
                  <td colspan="3" ><strong>Order No: </strong> <?php echo ($info["bh_no"]); ?></td>
                  <td>&nbsp;</td>
                </tr>
                   
			  <tr>
                  <td colspan="3" ><strong>Restaurant Name: </strong> <?php echo ($info["nickname"]); ?></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" ><strong>Payment Method:  </strong><?php echo ($info["bh_payment"]); ?></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" ><strong>Order Receiving Method:  </strong><?php echo ($info["bh_type"]); ?></td>
                  <td>&nbsp;</td>
                </tr>
                                <!-- <tr>
                  <td colspan="3" ><strong>Deliver Date &amp; Time: </strong>03-31-2014 10:49 </td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" ><strong>Submitation Date &amp; Time: </strong>03-31-2014 10:49:34 </td>
                  <td>&nbsp;</td>
                </tr> -->
                <tr>
                  <td colspan="3" ><strong>Special Requests/Notes: </strong><?php echo ($info["bn_note"]); ?> </td>
                  <td>&nbsp;</td>
                </tr>

                <tr>
                  <td colspan="3" class="style1"><HR width="100%" noShade SIZE=1></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="3" class="style3"><strong>Order Detail:</strong></td>
                  <td>&nbsp;</td>
                </tr>
                                 <tr> 
                  <td colspan="3"><strong>Item Code:</strong><?php echo ($info["item_id"]); ?> </td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="3"><strong>Item Title:</strong> <?php echo ($info["item_name"]); ?></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="3"><strong>Quantity:</strong> <?php echo ($info["bi_quantity"]); ?></td>
                  <td>&nbsp;</td>
                </tr>
              
               
				                <tr> 
                  <td colspan="3"><strong>Item Price:</strong>$<?php echo ($info["price"]); ?></td>
                  <td>&nbsp;</td>
                </tr>
               	                <tr>
                	<td colspan="3">
                    
                                        </td>                
                </tr>
                <tr> 
                	                  <td colspan="3">
                                    <strong>Item Total Price:</strong> $<?php echo ($info["bi_amount"]); ?></td>
                  <td>&nbsp;</td>
                </tr>
                                                 <tr> 
                  <td colspan="3" class="style1"><HR width="100%" noShade SIZE=1></td>
                  <td>&nbsp;</td>
                </tr>
                                 <tr> 
                  <td colspan="3"><strong>Coupon Discount:</strong>$0.00</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="3"><strong>Delivery:</strong>$0.00 </td>
                  <td>&nbsp;</td>
                </tr>
                                <tr> 
                  <td colspan="3" ><strong>Tax:</strong> $0.93</td>
                  <td>&nbsp;</td>
                </tr>
                				                 <tr> 
                  <td colspan="3" ><strong>Driver Tip:</strong> $0.00</td>
                  <td>&nbsp;</td>
                </tr>
                                                <tr> 
                  <td colspan="3" class="style1"><strong>Total: </strong>$12.93</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="3" class="style1"><HR width="100%" noShade SIZE=1></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td width="73%" align="right"><!--<input type="button" name="Submit" value="Update Order" onclick="javascript:updateOrder('34180')">&nbsp;&nbsp;--></td>
                  <td><input type="button" name="Submit" value=" Print view " onClick="javascript:showPopReport('34180');"></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
          </form></td>
        </tr>
       <!-- <tr align="left" valign="top"> 
          <td>&nbsp;</td>
        </tr>-->
      </table>
</div>
      
</td>
</div>
 	
         </div>   
            
        </div><!--End text_holder Div-->	
        <div id="footer">
            <div id="bottom">
                <div id="bottom_left"></div>
                <div id="bottom_right"></div>
            </div><!--End bottom Div--><br style="clear:both" />
        </div><!--End footer Div-->
    </div><!--End header Div-->
</div><!--End maincontainer Div-->
</body>
</html>