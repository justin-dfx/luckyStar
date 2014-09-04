<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>order</title>

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
      <li> <a href="__APP__/Order/index/restaurant_id/<?php echo ($_SESSION['restaurant_id']); ?>/status/3" class="selected_red" id="view">View Approved Orders</a> </li>
      |
      <li> <a href="__APP__/Order/index/restaurant_id/<?php echo ($_SESSION['restaurant_id']); ?>/status/0" class="" id="new">New Orders</a> </li>
      |
     <!--  <li> <a href="?mod=order&item=report" class="">Restaurant Order Report</a> </li> -->
      <li>
                <a href="__APP__/Order/index/restaurant_id/<?php echo ($_SESSION['restaurant_id']); ?>/status/6" class="" id="refund">Refund Orders</a>
              </li>
    </ul>
  </div>
  
<div id="main_heading"><?php if($_GET['status'] == '0'): ?>NEW ORDERS<?php elseif($_GET['status'] == 6): ?>REFUND ORDERS<?php else: ?>VIEW APPROVED ORDERS<?php endif; ?></div>
 
  <table width="100%" cellpadding="4" cellspacing="0" class="listig_table">
    <tr >
      <th width="34"><strong>#</strong></th>
      <th width="66"><strong>Order Date</strong></th>
	   <th width="100"><strong>Delivery/Pickup</strong></th>
      <th width="100"><strong>Customer Name</strong></th>
    </tr>
        <!-- test code ends-->
    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
            <td><a href="__APP__/Order/order_Info/order_id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["bh_no"]); ?></a></td>
      <td><?php echo ($vo["bh_create_time"]); ?></td>
	    <td><?php echo ($vo["bh_type"]); ?></td>
      <td><?php echo ($vo["account"]); ?></td>
    </tr><?php endforeach; endif; ?>
      </table>
</div>
 
</div>
 	
         </div>   
            


            <!--<script type="text/javascript">
            $(document).ready(function(){
              $("#new").click(function(){
                $('#view').removeAttr("class");
                $('#refund').removeAttr("class");
                $(this).addClass("selected_red");
                return false;
              });
            $("refund").click(function(){
                $('#view').removeAttr("class");
                $('#new').removeAttr("class");
                $(this).addClass("selected_red");
                return false;
            });
            $("#view").click(function(){
                $('#new').removeAttr("class");
                $('#refund').removeAttr("class");
                $(this).addClass("selected_red");
                return false;
              });
          });
</script>-->
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