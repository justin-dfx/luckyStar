<?php if (!defined('THINK_PATH')) exit();?><?php echo ($itemlist); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                            <img style="width:1085px; height:90px;" src="__PUBLIC__/Images/img_856_cat_header.jpg" border="0">
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
                                <li>
                                    <a href="?mod=menus&amp;catid=856" class="selected_red">Sub Menus Listing</a>
                                </li>
                                <li style="list-style: none">|
                                </li>
                                <li>
                                    <a href="__APP__/Menus/add_Cuisine" class="">Add Cuisine</a>
                                </li>
                                <li style="list-style: none">|
                                </li>
                                <li>
                                    <a href="__APP__/Menus/add_SubMenu" class="">Add Sub Menu</a>
                                </li>
                                <li style="list-style: none">|
                                </li>
                                <li>
                                    <a href="__APP__/Menus/add_Package" class="">Add Package</a>
                                </li>
                            </ul>
                        </div><br>
                        <script src="../js/jquery.js" type="text/javascript">
</script> <script src="../js/facebox.js" type="text/javascript">
</script> <script language="javascript" type="text/javascript">
jQuery(document).ready(function($) {
                        $('a[rel*=facebox]').facebox();
                        });
                        </script>
                        <div id="main_heading">
                            <div id="nav_links">
                            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><a href="__APP__/Menus/delete_Cuisine/cuisine_id/<?php echo ($vo["id"]); ?>" onclick="return confirm('Are you sure you would like to delete of this Menu?This sub menu and item of the menu will also be deleted')"><img src="__PUBLIC__/Images/enable.png" width="16" height="16" border="0" title="Delete"></a> <a style='color:#CC0000' href="__APP__/Menus/index/cuisine_id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["cuisine_name"]); ?></a>
                                 <a href="__APP__/Menus/add_Cuisine/id/<?php echo ($vo["id"]); ?>"><img src="__PUBLIC__/Images/page_white_edit.png" width="14" height="14" border="0" title="Edit"></a>
                                  |<?php endforeach; endif; ?>
                            </div>
                        </div>
                        <table width="100%" border="0">
                            <tr>
                                <td class="msg_warning">
                                    *Note: Click On Menu Items Name To Edit:
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                            </tr>
                        </table>
                        <div style="float:left; width:49%;height:auto;">
                        <p><strong>Sub Menu List</strong></p>
                        <table id="menulisting" width="100%" border="0" cellpadding="0" cellspacing="0">

                        <?php if(is_array($groupList)): $i = 0; $__LIST__ = $groupList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): ++$i;$mod = ($i % 2 )?><tr>
                                <td width="100%">
                                    <a href="__APP__/Menus/delete_SubMenu/group_id/<?php echo ($value["id"]); ?>" onclick="return confirm('Are you sure you would like to delete of this Sub Menu?This sub menu item will also be deleted.')"><img src="__PUBLIC__/Images/enable.png" width="16" height="16" border="0" title="Enabled"></a> <a href="__APP__/Menus/add_SubMenu/group_id/<?php echo ($value["id"]); ?>" class="largelink" title="Edit"><strong><?php echo ($value["group_name"]); ?></strong></a>&nbsp;&nbsp;<a href="__APP__/Menus/add_Item/group_id/<?php echo ($value["id"]); ?>" title="Add" class="smalllink">Add Items</a>
                                    <ul id="menus">
                                    <?php if(is_array($value['itemlist'])): $i = 0; $__LIST__ = $value['itemlist'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><li>
                                            <a href="__APP__/Menus/delete_Item/item_id/<?php echo ($v["id"]); ?>" onclick="return confirm('Are you sure you would like to delete of this Item?')"><img src="__PUBLIC__/Images/enable.png" width="16" height="16" border="0" title="Delete"></a> <a href="__APP__/Menus/add_Item/item_id/<?php echo ($v["id"]); ?>" class="mediumlink" title="Edit"><?php echo ($v["item_name"]); ?></a> &nbsp;&nbsp;<!-- <a href="__APP__/Menus/add_Attribute" class="smalllink" title="Add Attribute">Add Attribute</a> <a href="admin_contents/menus/popup.php?catid=856&amp;sub_cat=9602&amp;pid=76577" rel="facebox" class="smalllink" title="">associate item</a> -->
                                            <ul id="items"></ul>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>   
                                    </ul>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            
                            
                        </table>
                        </div>
                        <div style="float:right; width:49%;height:auto"> 
                        <p><strong>Package List</strong></p>
                        <table id="menulisting" width="100%" border="0" cellpadding="0" cellspacing="0" style="float:left;">
                        <?php if(is_array($packageList)): $i = 0; $__LIST__ = $packageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): ++$i;$mod = ($i % 2 )?><tr>
                                <td width="100%">
                                    <a href="__APP__/Menus/delete_Package/package_id/<?php echo ($row["id"]); ?>" onclick="return confirm('Are you sure you would like to delete of this Sub Menu?This Package group  will also be deleted.')"><img src="__PUBLIC__/Images/enable.png" width="16" height="16" border="0" title="Enabled"></a> <a href="__APP__/Menus/add_Package/package_id/<?php echo ($row["id"]); ?>" class="largelink" title="Edit"><strong><?php echo ($row["group_name"]); ?></strong></a>&nbsp;&nbsp;<a href="__APP__/Menus/add_Item/group_id/<?php echo ($value["id"]); ?>" title="Add" class="smalllink">Add Items</a>
                                    <ul id="menus">
                                    <?php if(is_array($row['groupList'])): $i = 0; $__LIST__ = $row['groupList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><li>
                                            <a href="__APP__/Menus/delete_Item/item_id/<?php echo ($v["id"]); ?>" onclick="return confirm('Are you sure you would like to delete of this Group?')"><img src="__PUBLIC__/Images/enable.png" width="16" height="16" border="0" title="Delete"></a> <a href="__APP__/Menus/add_Item/item_id/<?php echo ($v["id"]); ?>" class="mediumlink" title="Edit"><?php echo ($v["group_name"]); ?></a> &nbsp;&nbsp;<!-- <a href="__APP__/Menus/add_Attribute" class="smalllink" title="Add Attribute">Add Attribute</a> <a href="admin_contents/menus/popup.php?catid=856&amp;sub_cat=9602&amp;pid=76577" rel="facebox" class="smalllink" title="">associate item</a> -->
                                            <ul id="items"></ul>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>   
                                    </ul>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            
                            
                        </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div><!--End text_holder Div-->
            <div id="footer">
                <div id="bottom">
                    <div id="bottom_left"></div>
                    <div id="bottom_right"></div>
                </div><!--End bottom Div--><br style="clear:both">
            </div><!--End footer Div-->
        </div><!--End header Div-->
        <!--End maincontainer Div-->
    </body>
</html>