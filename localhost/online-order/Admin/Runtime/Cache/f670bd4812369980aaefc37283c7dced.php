<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>changepass</title>

<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery-ui-1.8.22.custom.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/Togle.js"></script>
<link href="__PUBLIC__/css/adminMain.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/south-street/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />


<!-- GOOGLE API KEY FOR DREAM HOST:  AIzaSyCkRkSd4hQornJOYjYMoHqi3-Wv4hVOOgg-->
<!-- GOOGLE API KEY FOR LOCAL PROJECT:  ABQIAAAAPpaOjFQ_miNP74G3g3O7oBTTwBGlz0OqYPu6tmNrU0ToxRrT5hQhlPr8PLUNIxb0D5FrOa5lJ1tp6w-->
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBT2sOPbIDLELZVjk6vPcGs87xqabq2jcs&sensor=false" type="text/javascript"></script>
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


                        <!--End navigation Div-->
            </div><!--End navigation_links Div-->
            <form method="post" action="__URL__/changePwd"  onsubmit="return validateCallback(this, dialogAjaxDone)">
  <div id="LoginContainer"><br />
<br />
<br />
<div id="TopNav" style="margin-right:">
  <table width="100%" border="0" cellspacing="5" cellpadding="0" style="margin:10px;">
        <tr>
      <td width="140" align="right" valign="middle"><strong>Old Password:</strong></td>
      <td align="left" valign="middle"><label>
        <input type="password" name="oldpassword" id="oldpass" style="width:200px;" />
        </label></td>
    </tr>
    <tr>
      <td align="right" valign="middle"><strong>New Password:</strong></td>
      <td align="left" valign="middle"><input type="password" name="password" id="pass" style="width:200px;" /></td>
    </tr>
    <tr>
      <td align="right" valign="middle"><strong>Confirm Password:</strong></td>
      <td align="left" valign="middle"><input type="password" name="repassword" id="confirm1" style="width:200px;" /></td>
    </tr>
     <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td align="left" valign="middle"><label>
        <input type="submit" name="submit" id="submit" value="Change" />
      </label></td>
    </tr>
  </table>
</div></div>
</form>
	
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