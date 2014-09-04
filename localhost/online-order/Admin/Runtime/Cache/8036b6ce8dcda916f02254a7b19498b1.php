<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>restocordobaordering</title>

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
            <div id="contents">
            	<div id="main_heading">
            		<form id="searchRestByUserFrm" name="searchRestByUserFrm" method="post" action="?mod=resturant">
	    			<select name="search_by" id="search_by" style="font-size:19px; margin-right:3px" onchange="" >
	    				<option value="0">===Search By===</option>
       		            <option value="1" >By Name</option>
       		            <option value="2" >By Email</option>
    		            <option value="3" >By Phone</option>
     		            <option value="4" >By Zip</option>
     		            <option value="5" >By Orders Status</option>
               		    <option value="6" >By Chargify Subscription ID</option>
       			    </select>
       			    <input name="search_field"  id="search_field" style="font-size:18px;" value="" type="text" />
		            <select name="search_field_1" id="search_field_1" style="font-size:18px; display: none;">
			    		<option value="green" >Green</option>
				    	<option value="yellow" >Yellow</option>
				    	<option value="red" >Red</option>
				    	<option value="grey" >Grey</option>
				    	<option value="deactivated" >Deactivated</option>
				    </select>
      		        <label>
       		            <input type="submit" name="sch_button" id="sch_button" value="Submit" class="btn"/>
       		        </label>
    		    </form>
		    </div>
		    <div id="contents_area" style="float:left; margin-left:15px; width:78%;">
		    	<strong  style="font-size:18px;">&nbsp;All Resturants</strong><br />
		    	<?php if(is_array($list)): foreach($list as $key=>$vo): ?><div class="listbox" onMouseOver="this.style.backgroundColor='#FFC';" onMouseOut="this.style.backgroundColor='';">
		    		<div id="imagebox" ><img src="<?php echo ($vo["logo"]); ?>" border="0" width="80" height="50" /> </div>
		    		<div id="URL_Links">
		    			<div id="title">
		    				<img src="__PUBLIC__/Images/red-light.gif" />
		    				<a href="__APP__/RestaurantDetails/index/restaurant_id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["nickname"]); ?></a>
		    			</div>
		    			<br style="clear:both" >
		    			<!-- <div id="Site_URL">
		    				Site URL:&nbsp;<a href="http://www.easywayordering.com/woow_sushi_algonquin/" target="_blank">http://wwww.easywayordering.com/ woow_sushi_algonquin/</a>
		                </div>
	                 	<div style="padding: 5px 10px 5px 0; float: left; width: 60px;">
			                <a href="?mod=analytics&item=orders&cid=856" class="tooltip" title="You had 0 orders over the last 30 days. That's 1  fewer  compared to the previous 30 day period.">
				                <span class="orders_count_container">
				             	<img src="__PUBLIC__/images/orders_icon.gif" />0 
					<img src="__PUBLIC__/images/red_arrow_down.gif" />
				</span>
			</a>
		</div> -->
		<!-- <div style="padding: 5px 10px 5px 0; float: left; width: 60px;">
			<a href="?mod=analytics&item=traffic&cid=856" class="tooltip" title="You had 0 visitors on your menu page over the last 30 days. That's 0  fewer  compared to the previous 30 day period.">
				<span class="orders_count_container">
				    <img src="__PUBLIC__/images/web_traffic_icon.gif" />0
				    <img src="__PUBLIC__/images/red_arrow_down.gif" />
				</span>
			</a>
		</div>
		<div style="padding: 5px 10px 5px 0; float: left; width: 60px;">
			<a href="?mod=analytics&item=abandoned_carts&cid=856" class="tooltip" title="You had 0 abandoned carts over the last 30 days. That's 0  fewer  compared to the previous 30 day period.">
				<span class="orders_count_container">
					<img src="__PUBLIC__/images/abandoned_cart_icon.png" />0
					<img src="__PUBLIC__/images/green_arrow_down.png" />
				</span>
			</a>
		</div> -->
	</div>
	</div><?php endforeach; endif; ?>
</div>
<br style="clear:both;" />
 </div>
<!--End body Div-->	
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