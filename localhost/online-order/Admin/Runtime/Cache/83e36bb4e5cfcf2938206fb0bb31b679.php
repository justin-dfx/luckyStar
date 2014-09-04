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
<!-- <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBT2sOPbIDLELZVjk6vPcGs87xqabq2jcs&sensor=false" type="text/javascript"></script> -->
<!--<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBT2sOPbIDLELZVjk6vPcGs87xqabq2jcs" type="text/javascript"></script> -->
</script>
<!--<script type="text/javascript" language="javascript">
	function initialize() {
		geocoder = new google.maps.Geocoder();
	}
</script>-->

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
                        </div>
<br>
<div id="main_heading">Add Menu Item</div>
<div class="form_outer">
<form name="form1" method="post" action="__APP__/Menus/add_Item"  enctype="multipart/form-data">
  <table width="500" border="0"  cellpadding="4" cellspacing="0">
  <tr align="left" valign="top">
      <td colspan="2"><strong>Is Item:</strong><br />

      <input name="is_item" type="radio"  id="is_item1" value="1" checked>  yes  
      <input name="is_item" type="radio"  id="is_item1" value="0">  no      </td>
    </tr>
    <tr align="left" valign="top">
      <td colspan="2"><strong>Item Title:</strong><br />

      <input name="item_name" type="text" size="40" id="item_name" value="<?php echo ($info["item_name"]); ?>">          </td>
    </tr>
    <tr align="left" valign="top">
      <td colspan="2"><strong>Item Title2:</strong><br />

      <input name="item_name2" type="text" size="40" id="item_name2" value="<?php echo ($info["item_name2"]); ?>">          </td>
    </tr>
    <tr align="left" valign="top">
        <td colspan="2"><strong>Item Description:</strong><br>
          <div class="msg_warning">To insert a new paragraph, enter &lt;P&gt;. 
          To bold text, surround text with &lt;B&gt;
          and &lt;/B&gt;. To italicize text, surround text with &lt;I&gt; 
          and &lt;/I&gt;.</div><br>
          <textarea name="item_desc" cols="40" rows="6" id="item_desc">     <?php echo ($info["description"]); ?>     </textarea>          </td>
    </tr>
    <tr align="left" valign="top">
        <td colspan="2"><strong>Item Description2:</strong><br>
          <div class="msg_warning">To insert a new paragraph, enter &lt;P&gt;. 
          To bold text, surround text with &lt;B&gt;
          and &lt;/B&gt;. To italicize text, surround text with &lt;I&gt; 
          and &lt;/I&gt;.</div><br>
          <textarea name="item_desc2" cols="40" rows="6" id="item_desc">    <?php echo ($info["description_chinese"]); ?>      </textarea>          </td>
    </tr>
    <tr align="left" valign="top">
      <td colspan="2"><strong>Price (in $):</strong>
      <font color="#666666">(ex. 10.00)</font> <br>           <input name="price" type="text" size="20" id="price" value="<?php echo ($info["price"]); ?>">          </td>
    </tr>
    <tr align="left" valign="top">
      <td colspan="2"><strong>Item Image:</strong><br />
      <input name="image" type="file" size="30">
      <input name="imagesrc" type="hidden" size="30" value="<?php echo ($info["imagesrc"]); ?>"></td>
    </tr>
    <?php if(!empty($info['imagesrc'])): ?><tr align="left" valign="top">
      <td colspan="2"><img src="<?php echo ($info["imagesrc"]); ?>" width="200"><br />
      </td>
    </tr><?php endif; ?>
    <!-- <tr align="left" valign="top">
      <td colspan="2"><strong>Check Items to Associate:</strong><br />
       <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76577"   />Edamame            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76578"   />Agedashi Tofu      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76579"   />Crispy Spring Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76580"   />Vegetable Egg Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76581"   />Gyoza	 	            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76583"   />Vegetable Gyoza      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76584"   />King Crab Rangoon (4pcs)            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76585"   />Yakitori      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76586"   />Shrimp Shumai            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76587"   />Vegetable Tempura      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76589"   />Tempura Squid            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76590"   />Beef Negimaki      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76591"   />Shrimp Vegetable Tempura            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76593"   />Soft Shell Crab      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76594"   />Thai Coconut Shrimp (6pcs)            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76595"   />Hamachi Kama      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76596"   />Yaki Beef (2pcs)            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76597"   />Fried Oyster (4pcs)      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76598"   />Sweet & Sour Shrimp (4pcs)            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76599"   />Ika Maruyaki      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76611"   />Sushi Appetizer            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76612"   />Sashimi Appetizer      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76613"   />Tuna Tartar Ring            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76614"   />Tuna Bowl      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76616"   />Tuna Tataki            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76617"   />Black Pepper Tuna      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76618"   /> Yellowtail Jalapeno            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76619"   />Woow Special Sashimi: Appetizer      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76621"   />Fatty Salmon Wrapped            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76622"   />Magical Spoon      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76623"   />Miso Soup            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76625"   />Clear Soup      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76626"   />Tom Yum Soup            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76627"   />Seafood Soup      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76628"   />Hot & Sour Soup            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76630"   />Egg Drop Soup      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76631"   />Wonton Soup            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76632"   />Ginger Salad      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76634"   />Cucumber Salad            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76635"   />Seaweed Salad      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76636"   />Avocado Salad            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76637"   />Squid Salad      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76638"   />Kani Salad            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76639"   />Egg      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76641"   />Crab Stick            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76642"   />Shrimp      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76643"   />Red Snapper            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76644"   />Squid      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76645"   />Mackerel            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76646"   />Stripe Bass      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76647"   />Octopus            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76648"   />Tuna      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76649"   />Salmon            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76650"   />Yellowtail      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76651"   />White Tuna            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76652"   />Fluke      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76653"   />Smoked Salmon            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76654"   />Eel      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76655"   />Red Clam            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76656"   />Salmon Roe      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76657"   />Sweet Shrimp            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76658"   />Spicy Scallop      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76659"   />Sea Urchin            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76660"   />Sea Urchin      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76661"   />King Crab            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76662"   />Fatty Tuna (Toro)      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76675"   />Avocado Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76677"   />Cucumber Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76678"   />Asparagus Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76679"   />Sweet Potato Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76682"   />California Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76683"   />Tuna Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76684"   />Salmon Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76686"   />Yellowtail Scallion Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76687"   />Spicy Salmon Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76688"   />Spicy Tuna Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76689"   />Spicy Yellowtail Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76692"   />Spicy Crab Stick Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76694"   />Tuna Avocado Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76695"   />Boston Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76696"   />Philadelphia Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76698"   />Alaskan Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76699"   />Rainbow Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76701"   />Eel Avocado Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76715"   />Shrimp Tempura Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76716"   />King Crab Avocado Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76717"   />Spider Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76718"   />Dragon Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76739"   />Godzilla Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76740"   />Red Dragon       <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76741"   />Crazy Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76742"   />007 Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76743"   />Angel Hair Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76744"   />Sweet Heart Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76746"   />Naruto Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76747"   />Volcano Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76748"   />Snow White Roll            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76749"   />Woow Special Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76750"   />Chef Special Roll             <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76751"   />Happy Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76753"   />Honey Roll             <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76754"   />Golden Dragon      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76756"   />Dynamite            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76757"   />Spiderman      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76758"   />Black Thunder            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76759"   />Fire Roll      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76765"   />Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76766"   />Beef      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76768"   />Filet Mignon            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76769"   />Scallop      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76771"   />Jumbo Shrimp             <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76772"   /> Salmon      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76773"   />Tuna             <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76774"   />Vegetable      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76775"   />Lobster             <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76816"   />Shrimp Tempura      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76817"   />Chicken Tempura            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76818"   />Seafood Tempura      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76819"   />Vegetables Tempura            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76824"   />Maki Combination      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76825"   />Spicy Maki Combination            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76826"   />Sushi Deluxe      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76827"   />Sashimi Deluxe            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76828"   />Chirashi      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76829"   />Sushi and Sashimi Combination            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76830"   />Sushi & Sashimi (for 2)      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76831"   />Eel Don            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76832"   />Tuna Don      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76833"   />Vegetable Sushi            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76846"   />Orange Chicken      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76847"   />Orange Beef            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76848"   />Orange Shrimp      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76849"   />Sesame Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76850"   />Sesame Shrimp      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76851"   />Sesame Scallop            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76854"   />General Tso's Chicken      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76855"   />Whiskey Beef            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76856"   />Jalapeno Steak (Super Spicy)      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76859"   />Coconut Prawn            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76860"   />Shrimp with Lobster Sauce      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76862"   />Buddha's Feast            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76879"   />Ginger Chicken        <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76882"   />Spicy Basil Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76883"   />Spicy Basil Shrimp      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76884"   />Siracha Beef            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76885"   />Mongolian Chicken      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76886"   />Mongolian Beef            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76887"   />Sizzling Pepper Steak      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76888"   />Salmon Delight            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76889"   />Seabass Flight      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76896"   />Lemongrass Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76898"   />Siracha Beef      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76900"   />Curry Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76903"   />Plain      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76904"   />Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76905"   />Beef       <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76906"   />Shrimp            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76909"   />Plain      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76912"   />Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76913"   />Beef      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76914"   />Shrimp            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76918"   />Vegetable      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76920"   />Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76921"   />Beef      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76922"   />Shrimp            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76923"   />Combo      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76924"   />Shrimp            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76925"   />Shrimp & Vegetable      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76926"   />Steak             <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76927"   />Plain      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76928"   />Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76929"   />Beef      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76930"   />Shrimp            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76931"   />House Special      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76932"   />Tropical            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76933"   />Curry      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76934"   />Soda (Free Refills)            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76935"   />Juice & Fruit Punch (No Free Refills)      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76936"   />Thai Iced Tea (No Free Refills)            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76939"   />Mochi Ice Cream      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76940"   />Traffic Light            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76941"   />Tempura Ice Cream      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76942"   />Tempura Cheese Cake            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76943"   />Chocolate Fudge      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76958"   />Tempura Shrimp            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76961"   />Tempura Chicken      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76962"   />Tempura Scallop            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76965"   />Tempura Vegetables      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76966"   />Teriyaki Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76967"   />Teriyaki Beef      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76968"   />Teriyaki Salmon            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76969"   />Any Two Rolls       <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76970"   />Any Three Rolls             <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76971"   />Chicken Broccoli      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76972"   />Chicken with Garlic Sauce            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76973"   />Kung Pao Chicken      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76974"   />Mongolian Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76975"   />Orange Chicken      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76976"   />General Tso's Chicken            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76977"   />Sesame Chicken      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76978"   />Sesame Tofu            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76979"   />Sesame Tofu      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76980"   />Tofu with Garlic Sauce            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76981"   />Beef Broccoli      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76982"   />Kung Pao Beef            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76983"   />Mongolian Beef      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76984"   />Orange Beef            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76985"   />Sizzling Pepper Beef      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76986"   />Shrimp Broccoli            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76987"   />Shrimp with Garlic Sauce      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76988"   />Spicy Basil Shrimp            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76989"   />Sushi Lunch      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76990"   />Sashimi Lunch            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76991"   />Vegetable Sushi Lunch      <br />      <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76992"   />Eel Don            <input  name="itemcheck[]" id="itemcheck" type="checkbox"  value="76993"   />Lunch Sushi & Sashimi Combo            
      </td> -->
    </tr>
   
    <tr align="left" valign="top">
      <td colspan="2"> 

      
      
      <input type="hidden" name="gid" id="gid" value="<?php echo ($info["id"]); ?>" />
      <?php if(!empty($info)): ?><input   type="submit" name="submit" id="save" value="Edit Item">
      <input type="hidden" name="cuisine_id" id="cuisine_id" value="<?php echo ($info["cuisine_id"]); ?>" />
      <input type="hidden" name="group_id" id="group_id" value="<?php echo ($info["group_id"]); ?>" />
      <?php else: ?>
      <input type="submit" name="submit" id="saveandnew" value="Save and New">
      <input type="submit" name="submit1" id="saveandnew" value="Save">
      <input type="hidden" name="cuisine_id" id="cuisine_id" value="<?php echo ($cuisine_id); ?>" />
      <input type="hidden" name="group_id" id="group_id" value="<?php echo ($group_id); ?>" /><?php endif; ?>
      </td>
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