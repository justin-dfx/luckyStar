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
	<label>DishesName：</label>
	<input type="text" class="required" size="30"   name="dishes_name" value="<?php echo ($vo["dishes_name"]); ?>">
</div>

<div class="unit">
	<label>Price：</label>
	<input type="text" class="required number" name="price" value="<?php echo ($vo["price"]); ?>">
</div>
			 <div class="unit">
				<label>Sequence：</label>
				<input type="text" name="sort" size="5" maxlength="20" class="required number" value="<?php echo ($vo["sort"]); ?>"/>
			</div>
 			<div class="unit">
				<label>DishesGroup：</label>
				<select name="group_id">
                <?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($v['id']); ?>" <?php if($v["id"] == $vo["group_id"]): ?>selected="selected"<?php endif; ?> ><?php echo ($v['group_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
               </select>
			</div>
           
 			<div class="unit">
				<label>Status：</label>
				<select name="status">
               		<option value="1" <?php if($vo["status"] == "1"): ?>selected="selected"<?php endif; ?>>display</option> 
                    <option value="0" <?php if($vo["status"] == "0"): ?>selected="selected"<?php endif; ?>>hide</option> 
               </select>
               <label>Recommend：</label>
				<select name="is_commend">
               		<option value="0" <?php if($vo["is_commend"] == "0"): ?>selected="selected"<?php endif; ?>>no</option> 
                    <option value="1" <?php if($vo["is_commend"] == "1"): ?>selected="selected"<?php endif; ?>>yes</option> 
               </select>
			</div>

            <div class="unit">
				<label>Peanut：</label>
				<select name="peanut">
               		<option value="1" <?php if($vo["peanut"] == "1"): ?>selected="selected"<?php endif; ?>>yes</option> 
                    <option value="0" <?php if($vo["peanut"] == "0"): ?>selected="selected"<?php endif; ?>>no</option> 
               </select>
               <label>Spicy：</label>
				<select name="spicy">
               		<option value="1" <?php if($vo["spicy"] == "1"): ?>selected="selected"<?php endif; ?>>yes</option> 
                    <option value="0" <?php if($vo["spicy"] == "0"): ?>selected="selected"<?php endif; ?>>no</option> 
               </select>
			</div>
            <div class="unit">
				<label>OpenHours：</label>
				<select name="start">
               		<option value="">Choose</option>
                    <option value="01:00AM" <?php if($list["start"] == '01:00AM'): ?>selected="selected"<?php endif; ?>>01:00AM</option> 
                    <option value="02:00AM" <?php if($list["start"] == '02:00AM'): ?>selected="selected"<?php endif; ?>>02:00AM</option> 
                    <option value="03:00AM" <?php if($list["start"] == '03:00AM'): ?>selected="selected"<?php endif; ?>>03:00AM</option> 
                    <option value="04:00AM" <?php if($list["start"] == '04:00AM'): ?>selected="selected"<?php endif; ?>>04:00AM</option> 
                    <option value="05:00AM" <?php if($list["start"] == '05:00AM'): ?>selected="selected"<?php endif; ?>>05:00AM</option> 
                    <option value="06:00AM" <?php if($list["start"] == '06:00AM'): ?>selected="selected"<?php endif; ?>>06:00AM</option> 
                    <option value="07:00AM" <?php if($list["start"] == '07:00AM'): ?>selected="selected"<?php endif; ?>>07:00AM</option> 
                    <option value="08:00AM" <?php if($list["start"] == '08:00AM'): ?>selected="selected"<?php endif; ?>>08:00AM</option> 
                    <option value="09:00AM" <?php if($list["start"] == '09:00AM'): ?>selected="selected"<?php endif; ?>>09:00AM</option> 
                    <option value="10:00AM" <?php if($list["start"] == '10:00AM'): ?>selected="selected"<?php endif; ?>>10:00AM</option> 
                    <option value="11:00AM" <?php if($list["start"] == '11:00AM'): ?>selected="selected"<?php endif; ?>>11:00AM</option>
                    <option value="12:00AM" <?php if($list["start"] == '12:00AM'): ?>selected="selected"<?php endif; ?>>12:00AM</option>   
               </select>
             <label style="width:10px;">to</label>
               <select name="end">
               		<option value="">Choose</option> 
                    <option value="01:00PM" <?php if($list["end"] == '01:00PM'): ?>selected="selected"<?php endif; ?>>01:00PM</option> 
                    <option value="02:00PM" <?php if($list["end"] == '02:00PM'): ?>selected="selected"<?php endif; ?>>02:00PM</option> 
                    <option value="03:00PM" <?php if($list["end"] == '03:00PM'): ?>selected="selected"<?php endif; ?>>03:00PM</option> 
                    <option value="04:00PM" <?php if($list["end"] == '04:00PM'): ?>selected="selected"<?php endif; ?>>04:00PM</option> 
                    <option value="05:00PM" <?php if($list["end"] == '05:00PM'): ?>selected="selected"<?php endif; ?>>05:00PM</option> 
                    <option value="06:00PM" <?php if($list["end"] == '06:00PM'): ?>selected="selected"<?php endif; ?>>06:00PM</option> 
                    <option value="07:00PM" <?php if($list["end"] == '07:00PM'): ?>selected="selected"<?php endif; ?>>07:00PM</option> 
                    <option value="08:00PM" <?php if($list["end"] == '08:00PM'): ?>selected="selected"<?php endif; ?>>08:00PM</option> 
                    <option value="09:00PM" <?php if($list["end"] == '09:00PM'): ?>selected="selected"<?php endif; ?>>09:00PM</option> 
                    <option value="10:00PM" <?php if($list["end"] == '10:00PM'): ?>selected="selected"<?php endif; ?>>10:00PM</option> 
                    <option value="11:00PM" <?php if($list["end"] == '11:00PM'): ?>selected="selected"<?php endif; ?>>11:00PM</option>
                    <option value="12:00PM" <?php if($list["end"] == '12:00PM'): ?>selected="selected"<?php endif; ?>>12:00PM</option> 
               </select>
			</div>
			<div class="unit">
				<label>Image：</label>
				<a href="<?php echo ($vo["image"]); ?>" target="_blank" style="color:#3C7FB1;">Preview</a> <input name="image" type="file" />
			</div>
            <div class="unit">
				<label>Description：</label>
				<textarea name="description" style="width:300px;height:100px;"><?php echo ($vo["description"]); ?></textarea>
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