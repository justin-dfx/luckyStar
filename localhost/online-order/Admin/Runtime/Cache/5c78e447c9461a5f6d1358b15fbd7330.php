<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>restocordobaordering</title>
<link href="__PUBLIC__/css/adminMain.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/south-street/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />
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
    <li><a href="__APP__/Menus/index"class="">Sub Menus Listing</a></li> | 
    <li><a href="__APP__/Menus/add_Cuisine" >Add Cuisine</a></li> |
    <li><a href="__APP__/Menus/add_SubMenu" class="selected_red">Add Sub Menu</a></li>
    <li style="list-style: none">| </li>
    <li><a href="__APP__/Menus/add_Package" class="">Add Package</a></li> 
    
    </ul>
</div>
<br>
<div id="main_heading">Add Sub Menu</div>
  <div class="form_outer">
  <form name="supcatform" method="post" action="__APP__/Menus/add_SubMenu">
  <table width="500" border="0" cellpadding="4" cellspacing="0">
   <tr>
  <td><strong>Cuisine Name:</strong><br />
    <select name="cuisine_name" style="width:330px;">
    <?php if(empty($info['id'])): ?><option selected="selected" value="0">=====Select Cuisine=====</option><?php endif; ?>
    
    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo["id"] == $info.id): ?>selected="selected"<?php endif; ?>><?php echo ($vo["cuisine_name"]); ?></option><?php endforeach; endif; ?>
    </select></td>
  </tr>
   <tr>
   <td><strong>Sub Menu Name:</strong><br />
  
    <input name="menu_name" type="text" id="menu_name" size="50" value="<?php echo ($info['group_name']); ?>"></td>
  </tr>
  <td><strong>Sub Menu Name2:</strong><br />
  
    <input name="menu_name2" type="text" id="menu_name2" size="50" value="<?php echo ($info['group_name2']); ?>"></td>
  </tr>
  <tr>
  <td><strong>Sub Menu Ordering #:</strong><br />
    <input name="menu_ordering" type="text" id="menu_ordering" size="50" value="<?php echo ($info['ordering']); ?>"></td>
  </tr>
  <tr align="left" valign="top">
  <td><strong>Sub Menu Description:</strong><br>
                <em><font color="#666666">(To insert a new paragraph, enter &lt;P&gt;. 
                To bold text, surround text with &lt;B&gt; and &lt;/B&gt;. To italicize text, surround text with &lt;I&gt; 
                and &lt;/I&gt;.)</font></em><br />
  <textarea name="menu_desc" cols="40" rows="6" id="menu_desc"><?php echo ($info['remark']); ?></textarea></td>
  </tr>
  <tr>
  
 
  <td><input type="submit" name="submit" value="Submit" />
  
  
  <input type="hidden" name="gid" id="gid"  value="<?php echo ($info['id']); ?>"/></td>
  </tr>
  </table>
  </form>
</div>
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