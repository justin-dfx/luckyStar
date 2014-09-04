<?php if (!defined('THINK_PATH')) exit();?><div class="page">
	<div class="pageContent">


	<form method="post" action="__URL__/update/navTabId/__MODULE__" class="pageForm required-validate" onsubmit="return iframeCallback(this, dialogAjaxDone)" enctype="multipart/form-data">
		<input type="hidden" name="user_id" value="<?php echo $_SESSION[C('USER_AUTH_KEY')] ?>"/>
		<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
		<div class="pageFormContent" layoutH="58">
		
<!-- 
<div class="unit">
	<label>重置密码：</label>
	<input type="text" name="resetPwd" > <INPUT type="button" value="重置密码" onclick="resetPwd()" class="submit" style="height:25px">
</div>
-->

<div class="unit">
	<label>Username：</label>
	<input type="text" class="required email"   name="account" size="30" maxlength="100" value="<?php echo ($vo["account"]); ?>">
</div>

<div class="unit">
	<label>Name：</label>
	<input type="text" class="required"   name="name" size="30" maxlength="100" value="<?php echo ($vo["name"]); ?>">
</div>
<div class="unit">
	<label>Phone：</label>
	<input type="text" class="required phone" name="phone" size="30" maxlength="100" value="<?php echo ($vo["phone"]); ?>">
</div>
<div class="unit">
	<label>RestaurantName：</label>
	<input type="text" name="nickname" size="30" maxlength="100" class="required" value="<?php echo ($vo["nickname"]); ?>"/>
</div>
<div class="unit">
	<label>RestaurantTel：</label>
	<input type="text" name="tel" size="30" maxlength="100" class="required phone" value="<?php echo ($vo["tel"]); ?>"/>
</div>
<div class="unit">
	<label>RestaurantFax：</label>
	<input type="text" name="resfax" size="30" maxlength="100" class="required phone" value="<?php echo ($vo["resfax"]); ?>"/>
</div>
<div class="unit">
	<label>Address：</label>
	<input type="text" class="required" name="address" size="30" maxlength="100" value="<?php echo ($vo["address"]); ?>">
</div>
<div class="unit">
	<label>OpeningHours：</label>
	<input type="text" class="required" name="opening_hours" size="30" maxlength="100" value="<?php echo ($vo["opening_hours"]); ?>">
</div>

<div class="unit">
	<label>Status：</label>
	<select class="small bLeft"  name="status">
		<option <?php if(($vo["status"])  ==  "1"): ?>selected<?php endif; ?> value="1">Enable</option>
		<option <?php if(($vo["status"])  ==  "0"): ?>selected<?php endif; ?> value="0">Disabled</option>
	</select>
</div>
<div class="unit">
	<label>BusinessStatus<?php echo ($vo["business_status"]); ?>：</label>
	<select class="small bLeft"  name="business_status">
		<option <?php if(($vo["business_status"])  ==  "1"): ?>selected<?php endif; ?> value="1">Business</option>
		<option <?php if(($vo["business_status"])  ==  "0"): ?>selected<?php endif; ?> value="0">Stop</option>
	</select>
</div>
<div class="unit">
				<label>Logo：</label>
				<label><img src="<?php echo ($vo["logo"]); ?>" width="120" height="56" /><br /><input type="file" name="logo" /></label>
			</div>
<div class="unit">
				<label>Remark：</label>
				<textarea name="remark" style="width:300px;height:100px;"><?php echo ($vo["remark"]); ?></textarea>
			</div>

</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">Submit</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">Cancel</button></div></div></li>
			</ul>
		</div>
	</form>
	
	</div>
</div>