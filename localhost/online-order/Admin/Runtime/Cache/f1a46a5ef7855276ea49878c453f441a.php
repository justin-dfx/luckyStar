<?php if (!defined('THINK_PATH')) exit();?>﻿

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coupons</title>

<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery-ui-1.8.22.custom.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/Togle.js"></script>
<link href="__PUBLIC__/css/adminMain.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/south-street/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />


<!-- GOOGLE API KEY FOR DREAM HOST:  AIzaSyCkRkSd4hQornJOYjYMoHqi3-Wv4hVOOgg-->
<!-- GOOGLE API KEY FOR LOCAL PROJECT:  ABQIAAAAPpaOjFQ_miNP74G3g3O7oBTTwBGlz0OqYPu6tmNrU0ToxRrT5hQhlPr8PLUNIxb0D5FrOa5lJ1tp6w-->
<!-- <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBT2sOPbIDLELZVjk6vPcGs87xqabq2jcs&sensor=false" type="text/javascript"></script> -->
<!--<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBT2sOPbIDLELZVjk6vPcGs87xqabq2jcs" type="text/javascript"></script> -->
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
   	
   <div id="navigation_links">
   <div id="navigation">
    
    <div class="links "><a href="?mod=resturant&item=restedit&cid=856" >Restaurant</a></div>
    <div class="links "><a href="?mod=order&cid=856" class="">Orders(1)</a></div>
   	<div class="links "><a href="?mod=customer&cid=856" class="">Customers(0)</a></div>
    <div class="links selected"><a href="?mod=coupon&cid=856" class="">Coupons</a></div>
    <div class="links "><a href="?mod=menus&cid=856"class="">Menus</a></div>
    <div class="links "><a href="?mod=mailing_list&cid=856"class="">Mailing List</a></div>
    			<div class="links "><a href="?mod=analytics&cid=856"class="">Analytics</a></div>
                	    <br style="clear:both" />
  </div>
</div>
<div id="tab_items">
	<ul>
    	<li>
			<a href="?mod=coupon&item=main&cid=856">Edit Exisiting Coupons</a>
        </li>|
        <li>
        	<a href="__APP__/Coupons/addCoupons">Add New Coupon</a>
        </li>
     </ul>
</div>

<div id="main_heading">EDIT / REMOVE COUPONS</div>
 
  <table width="100%" border="0"  cellpadding="4" cellspacing="0" class="listig_table">
     <tr>
      	<th width="12%"><strong>coupon code</strong></th>
        <th width="16%"><strong>Coupon title</strong></th>
        <th width="22%"><strong>Coupon date</strong></th>
        <th width="50%"><strong>Action</strong></th>
      </tr>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
        <td><?php echo ($vo["code"]); ?></td>
        <td><?php echo ($vo["title"]); ?></td>
        <td><?php echo ($vo["date"]); ?></td>
        <td><?php echo ($vo["code"]); ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

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