<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>restocordobaordering</title>

<link href="__PUBLIC__/css/adminMain.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/south-street/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#addgroupbox").hide();
  $("#add_group").click(function(){
    $("#form1").submit();  
  });
});
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
                                <li>
                                    <a href="?mod=menus&amp;catid=856" class="">Sub Menus Listing</a>
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
                                    <a href="__APP__/Menus/add_Package" class="selected_red">Add Package</a>
                                </li>
                            </ul>
                        </div><br>





<div id="main_heading">Add Package</div>

<div class="form_outer">
  <form name="form1" method="post" action="__APP__/Menus/add_Package"  >
    <table width="100%" border="0" cellpadding="4" cellspacing="0">
      <tr align="left" valign="top">
        <td width="172"><strong>Package From:</strong></td>
        <td width="973">
        <select name="cuisine_name" type="text" id="cuisine_name" style="width:" >
          <option value="0">=====Select Cuisine=====</option>
        <?php if(is_array($CuisineList)): foreach($CuisineList as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if($info['cuisine_id'] == $vo['id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["cuisine_name"]); ?></option><?php endforeach; endif; ?>
        </select>
        </td>
      </tr>
      <tr align="left" valign="top">
        <td width="172"><strong>Package Name:</strong></td>
        <td width="973"><input name="group_name" type="text" size="40" id="coupon_title" value="<?php echo ($info["group_name"]); ?>"></td>
      </tr>
      <tr align="left" valign="top">
        <td><strong>Package Name2:</strong></td>
        <td><input name="group_name2" maxlength="11" type="text" size="40" id="coupon_code" value="<?php echo ($info["group_name2"]); ?>"></td>
      </tr>
      <tr align="left" valign="top">
        <td width="172"><strong>Package Price:</strong></td>
        <td><input name="price" type="text" size="40" id="min_order_total" value="<?php echo ($info["price"]); ?>"></td>
      </tr>
      <tr align="left" valign="top">
        <td><strong>Package Type:</strong></td>
        <td><input type="radio" name="group_type" id="discount_in" value="0" <?php if($info['group_type'] == 0): ?>checked="checked"<?php endif; ?> />
          Choose&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio" name="group_type" id="discount_in" value="1"<?php if($info['group_type'] == 1): ?>checked="checked"<?php endif; ?> />
          Pick</td>
      </tr>     

      <tr align="left" valign="top">
        <td>&nbsp;</td>

        <td>
        <?php if(empty($info)): ?><input type="submit" name="submit" id="add_group" value="Add Group">
        <?php else: ?>
        <input type="submit" name="submit" id="add_group" value="Edit">
        <input type="submit" name="submit" id="add_group" value="Add Group"><?php endif; ?>
            <input type="hidden" name="gid" value="<?php echo ($info["id"]); ?>"></td>
      </tr>
    </table>
  </form>
</div>

<!-- <div class="addgroupbox" id="addgroupbox">
  <div id="AdminLeftConlum">
    <form name="frmedit" id="frmedit" action="" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" cellpadding="4" cellspacing="0">
            <tbody>
              <tr align="left" valign="top">
                <td>&nbsp;</td>
                <td>
                    <input type="submit" name="submit" id="submit" value="Add Option">
                    <input type="button" name="btnSave" value="从其他modifier中选择" onclick="showLocation();">
                </td>
            </tr>
              <tr align="left" valign="top">
                <td width="76">&nbsp;</td>
                <td width="1052"><strong>You selected item(click name edit):</strong><br>
                    <textarea name="catname" cols="35" id="itemname" >薄饼普通饼=1.00厚饼=2.00</textarea>
                    <p>每个attribute为一行，如果加价，在后面加上=1.00等。</p>
                  </td>
              </tr>              
              <tr align="left" valign="top"> 
                <td width="76"></td>
                <td><strong>Option Name:</strong><br>
                    <input name="Option Name" type="text" size="40" value="Choose a kind of soup" id="Option Name"> </td>
              </tr>         
           
            <tr align="left" valign="top"> 
                <td></td>
                <td><strong>Option Name2:</strong><br>
                   <input name="Option Name2" type="text" size="40" value="选择一种饼" id="Option Name2">
                </td>
            </tr>
             <tr align="left" valign="top"> 
                <td></td>
                <td><strong>Option type:</strong><br>
                   <input  type="radio"  name="Option type" id="" value="Radio" />Radio
                   <input  type="checkbox"  name="Option type" id="" value="Checkbox" />Checkbox
                </td>
            </tr>

             <tr align="left" valign="top"> 
                <td></td>
                <td><strong>If you select the check box:</strong><br><strong>Max Select</strong><br>
                   <input name="" type="text" size="40" value="4" id="Option Name2">

                </td>
            </tr>
         
            <tr align="left" valign="top">
                <td>&nbsp;</td>
                <td>
                    <input type="submit" name="submit" id="submit" value="complete">
                    <input type="button" name="btnSave" value="Save and Continue" onclick="showLocation();">
                </td>
            </tr>
        </tbody>
      </table>
    </form>
</div> -->
<!-- <div id="addgroupConlum">
  <h1>Alert window 为用户之前添加果断attribute，可选择option过滤。</h1>
  <select name="option" id="option" style="width:270px;" class="valid">
    <option value="-1">option1</option>
    <option value="167">option2</option>
    <option value="168">option3</option>
    <option value="169">option4</option>
    <option value="170">option5</option>
    <option value="171" selected="">option6</option>
    <option value="172">option7</option>                    
  </select>
  <form class="addform">
    <table width="100%" border="0" cellpadding="3" cellspacing="0">
      <tbody>
        <tr align="left" valign="top"> 
          <td width="33.3333%"><input  type="checkbox"  name="Option type" id="" value="Checkbox" />薄饼</td>
          <td width="33.3333%"><input  type="checkbox"  name="Option type" id="" value="Checkbox" />item1</td>
          <td width="33.3333%"><input  type="checkbox"  name="Option type" id="" value="Checkbox" />item2</td>
        </tr>
        <tr align="left" valign="top"> 
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />普通饼=1.00</td>
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />item3</td>
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />item4</td>
        </tr>
        <tr align="left" valign="top"> 
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />厚饼=2.00</td>
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />item5</td>
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />item6</td>
        </tr>
        <tr align="left" valign="top"> 
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />普通饼=1.00</td>
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />item3</td>
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />item4</td>
        </tr>
        <tr align="left" valign="top"> 
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />厚饼=2.00</td>
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />item5</td>
          <td><input  type="checkbox"  name="Option type" id="" value="Checkbox" />item6</td>
        </tr> 
        <tr align="left" valign="top" class="addgroupbtn">
                <td>&nbsp;</td>
                <td>
                    <input type="submit" name="submit" id="submit" value="cancel">
                    <input type="button" name="btnSave" value="Select All" onclick="showLocation();">
                </td>
            </tr>
      </tbody>
    </table> 
  </form> -->
    
</div>
<br class="clearfloat">
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