<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
<!--
function selectApp_module(groupId, appId){
	var url = "__URL__/module/groupId/"+ groupId +"/appId/" + appId;
	$("#moduleSelectBox", $.pdialog.getCurrent()).loadUrl(url);
}

function selectApp_action(form$){
	var $form = $(form$, $.pdialog.getCurrent())
	var groupId = $form.find(":input[name=groupId]").val();
	var appId = $form.find(":input[name=appId]").val();
	var url = "__URL__/action/groupId/"+ groupId +"/appId/" + appId;
	$("#moduleSelectBox", $.pdialog.getCurrent()).loadUrl(url);
}
function selectModule_action(form$){
	var $form = $(form$, $.pdialog.getCurrent())
	var groupId = $form.find(":input[name=groupId]").val();
	var appId = $form.find(":input[name=appId]").val();
	var moduleId = $form.find(":input[name=moduleId]").val();
	var url = "__URL__/action/groupId/"+ groupId +"/appId/" + appId + "/moduleId/" + moduleId;
	$("#actionSelectBox", $.pdialog.getCurrent()).loadUrl(url);
}
//-->
</script>

<div class="page">
	<div class="tabs">
		<div class="tabsHeader">
			<div class="tabsHeaderContent">
				<ul>
					<li class="selected"><a href="#"><span>应用授权</span></a></li>
					<li><a href="__URL__/module/groupId/<?php echo ($_GET['groupId']); ?>" class="j-ajax"><span>模块授权</span></a></li>
					<li><a href="__URL__/action/groupId/<?php echo ($_GET['groupId']); ?>" class="j-ajax"><span>操作授权</span></a></li>
				</ul>
			</div>
		</div>
		
		<div class="tabsContent" >
			<div>
				<form method="post" action="__URL__/setApp" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
					<input type="hidden" name="groupId" VALUE="<?php echo ($_GET['groupId']); ?>" />
					<div class="pageFormContent" layoutH="100">
						<?php if(is_array($appList)): $i = 0; $__LIST__ = $appList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><div class="unit">			
								<input <?php echo in_array($key, $groupAppList) ? "checked" : "" ?> type="checkbox" name="groupAppId[]" value="<?php echo ($key); ?>"/><?php echo ($item); ?>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div class="formBar">
						<label style="float:left"><input type="checkbox" class="checkboxCtrl" group="groupAppId[]" />全选</label>
						<ul>
							<li><div class="button"><div class="buttonContent"><button type="button" class="checkboxCtrl" group="groupAppId[]" selectType="invert">反选</button></div></div></li>
							<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
							<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
						</ul>
					</div>
				</form>				
			</div>
			
			<div>
				<!-- <?php if(empty($_GET['appId'])): ?><form method="post" action="__URL__/setModule" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
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

 -->
			</div>
			<div>
				<!-- <?php if(!empty($_GET['appId']) and !empty($_GET['moduleId'])): ?><?php if(is_array($actionList)): $i = 0; $__LIST__ = $actionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><div class="unit">
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
 -->
			</div>
		</div>
		<div class="tabsFooter">
			<div class="tabsFooterContent"></div>
		</div>
	</div>
</div>