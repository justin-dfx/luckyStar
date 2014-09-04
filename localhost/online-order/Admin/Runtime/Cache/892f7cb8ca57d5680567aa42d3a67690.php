<?php if (!defined('THINK_PATH')) exit();?><?php if(empty($_GET['appId'])): ?><form method="post" action="__URL__/setModule" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<input type="hidden" name="groupId" VALUE="<?php echo ($_GET['groupId']); ?>" />
		<div class="pageFormContent" layoutH="100" layoutType="dialog">
			<div class="unit">
				<label>Applicaion:</label>
				<select name="appId" onchange="selectApp_module('<?php echo ($_GET['groupId']); ?>', this.value)">
					<option value="">Choose</option>
					<?php if(is_array($appList)): $i = 0; $__LIST__ = $appList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($key); ?>" <?php echo in_array($key, $selectAppId) ? "selected" : "" ?>><?php echo ($item); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
			
			<div id="moduleSelectBox">
			<?php if(is_array($moduleList)): $i = 0; $__LIST__ = $moduleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><div class="unit">
				<input <?php echo in_array($key, $groupModuleList) ? "checked" : "" ?> type="checkbox" name="groupModuleId[]" value="<?php echo ($key); ?>"/><?php echo ($item); ?>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="formBar">
			<label style="float:left"><input type="checkbox" class="checkboxCtrl" group="groupModuleId[]" />全选</label>
			<ul>
				<li><div class="button"><div class="buttonContent"><button type="button" class="checkboxCtrl" group="groupModuleId[]" selectType="invert">反选</button></div></div></li>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" onclick="$.pdialog.closeCurrent()">取消</button></div></div></li>
			</ul>
		</div>
	</form>
	
<?php else: ?>

	<?php if(is_array($moduleList)): $i = 0; $__LIST__ = $moduleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><div class="unit">
		<input <?php echo in_array($key, $groupModuleList) ? "checked" : "" ?> type="checkbox" name="groupModuleId[]" value="<?php echo ($key); ?>"/><?php echo ($item); ?>
	</div><?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?>