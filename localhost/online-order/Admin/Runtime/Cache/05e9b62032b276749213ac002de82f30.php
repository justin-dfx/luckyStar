<?php if (!defined('THINK_PATH')) exit();?><?php if(!empty($_GET['appId']) and !empty($_GET['moduleId'])): ?><?php if(is_array($actionList)): $i = 0; $__LIST__ = $actionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><div class="unit">
	<input <?php echo in_array($key, $groupActionList) ? "checked" : "" ?> type="checkbox" name="groupActionId[]" value="<?php echo ($key); ?>"/><?php echo ($item); ?>
</div><?php endforeach; endif; else: echo "" ;endif; ?>

<?php elseif(!empty($_GET['appId'])): ?>
	<div class="unit">
	<label>Module:</label>
	<select name="moduleId" onchange="selectModule_action('#setActionAction')">
		<option value="">Choose</option>
		<?php if(is_array($moduleList)): $i = 0; $__LIST__ = $moduleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($key); ?>" <?php echo in_array($key, $selectModuleId) ? "selected" : "" ?>><?php echo ($item); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	</select>
</div>

<div id="actionSelectBox">
	<?php if(is_array($actionList)): $i = 0; $__LIST__ = $actionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><div class="unit">
		<input <?php echo in_array($key, $groupActionList) ? "checked" : "" ?> type="checkbox" name="groupActionId[]" value="<?php echo ($key); ?>"/><?php echo ($item); ?>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<?php else: ?>

	<form id="setActionAction" method="post" action="__URL__/setAction" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<input type="hidden" name="groupId" VALUE="<?php echo ($_GET['groupId']); ?>" />
		<div class="pageFormContent" layoutH="100" layoutType="dialog">
			<div class="unit">
				<label>Applicaion:</label>
				<select name="appId" onchange="selectApp_action('#setActionAction')">
					<option value="">Choose</option>
					<?php if(is_array($appList)): $i = 0; $__LIST__ = $appList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($key); ?>" <?php echo in_array($key, $selectAppId) ? "selected" : "" ?>><?php echo ($item); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
			<div id="moduleSelectBox">
				<div class="unit">
	<label>Module:</label>
	<select name="moduleId" onchange="selectModule_action('#setActionAction')">
		<option value="">Choose</option>
		<?php if(is_array($moduleList)): $i = 0; $__LIST__ = $moduleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($key); ?>" <?php echo in_array($key, $selectModuleId) ? "selected" : "" ?>><?php echo ($item); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	</select>
</div>

<div id="actionSelectBox">
	<?php if(is_array($actionList)): $i = 0; $__LIST__ = $actionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><div class="unit">
		<input <?php echo in_array($key, $groupActionList) ? "checked" : "" ?> type="checkbox" name="groupActionId[]" value="<?php echo ($key); ?>"/><?php echo ($item); ?>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
			</div>
		</div>
		<div class="formBar">
			<label style="float:left"><input type="checkbox" class="checkboxCtrl" group="groupActionId[]" />全选</label>
			<ul>
				<li><div class="button"><div class="buttonContent"><button type="button" class="checkboxCtrl" group="groupActionId[]" selectType="invert">反选</button></div></div></li>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" onclick="$.pdialog.closeCurrent()">取消</button></div></div></li>
			</ul>
		</div>
	</form><?php endif; ?>