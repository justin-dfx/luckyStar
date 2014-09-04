<?php if (!defined('THINK_PATH')) exit();?>
<div class="page">
	<div class="pageContent">
	
	<form action="__URL__/setUser" method="post" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="groupId" VALUE="<?php echo ($_GET['id']); ?>" />
		<div class="pageFormContent" layoutH="58">
			<?php if(is_array($userList)): $i = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><div class="unit">
				<input type="checkbox" name="groupUserId[]" value="<?php echo ($key); ?>" <?php echo in_array($key, $groupUserList) ? "checked" : "" ?>/><?php echo ($item); ?>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="formBar">
			<label style="float:left"><input type="checkbox" class="checkboxCtrl" group="groupUserId[]" />Select All</label>
			<ul>
			<!--
			<li><div class="button"><div class="buttonContent"><button type="button" class="checkboxCtrl" group="groupUserId[]" selectType="all">All check</button></div></div></li>
			<li><div class="button"><div class="buttonContent"><button type="button" class="checkboxCtrl" group="groupUserId[]" selectType="none">All uncheck</button></div></div></li>
			-->
			<li><div class="button"><div class="buttonContent"><button type="button" class="checkboxCtrl" group="groupUserId[]" selectType="invert">Invert</button></div></div></li>
			<li><div class="buttonActive"><div class="buttonContent"><button type="submit">Save</button></div></div></li>
			<li><div class="button"><div class="buttonContent"><button type="button" class="close">Cancel</button></div></div></li>
			</ul>
		</div>
	</form>
	
	</div>
</div>