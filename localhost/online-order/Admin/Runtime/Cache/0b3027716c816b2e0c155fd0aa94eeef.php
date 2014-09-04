<?php if (!defined('THINK_PATH')) exit();?>
<script language="JavaScript">
<!--
function checkName(){
	ThinkAjax.send('__URL__/checkAccount/','ajax=1&account='+$F('account'));
}
//-->
</script>

<div class="page">
	<div class="pageContent">
	
	<form method="post" action="__URL__/insert/navTabId/__MODULE__" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<div class="pageFormContent" layoutH="58">

			<div class="unit">
				<label>GroupName：</label>
				<input type="text" class="required" size="30" maxlength="100" name="group_name"/>
			</div>
            <div class="unit">
				<label>ChineseName：</label>
				<input type="text" class="required" size="30" maxlength="100" name="cn_name"/>
			</div>
			<div class="unit">
				<label>Sequence：</label>
				<input type="text" name="sort" size="5" maxlength="20" class="required number" value="0"/>
			</div>
            <div class="unit">
				<label>Restaurant：</label>
				<select name="restaurant_id">
                <?php if(is_array($rs_list)): $i = 0; $__LIST__ = $rs_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['nickname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
               </select>
			</div>
			<div class="unit">
				<label>Status：</label>
				<select name="status">
					<option value="1">显示</option>
					<option value="0">隐藏</option>
				</select>
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