<?php if (!defined('THINK_PATH')) exit();?><div class="page">
	<div class="pageContent">

	<form method="post" action="__URL__/update/navTabId/__MODULE__" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<input type="hidden" name="user_id" value="<?php echo $_SESSION[C('USER_AUTH_KEY')] ?>">
		<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" >
		<input type="hidden" name="ajax" value="1">
		<input type="hidden" name="pid" value="<?php echo ($vo["pid"]); ?>">
		<div class="pageFormContent" layoutH="58">
			<div class="unit">
				<label>模块名：</label>
				<input type="text" class="required alphanumeric"  name="name" value="<?php echo ($vo["name"]); ?>">
			</div>

			<div class="unit">
				<label>显示名：</label>
				<input type="text" class="required"  name="title" value="<?php echo ($vo["title"]); ?>">
			</div>
			<div class="unit">
				<label>分 组：</label>
				<select name="group_id">
					<option value="">未分组</option>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($group["id"]); ?>" <?php if(($group["id"])  ==  $vo['group_id']): ?>selected<?php endif; ?>><?php echo ($group["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>

			<div class="unit">
				<label>状态：</label>
				<select name="status">
					<option <?php if(($vo["status"])  ==  "1"): ?>selected<?php endif; ?> value="1">启用</option>
					<option <?php if(($vo["status"])  ==  "0"): ?>selected<?php endif; ?> value="0">禁用</option>
				</select>
			</div>

			<div class="unit">
				<label>描 述：</label>
				<textarea name="remark"  rows="3" cols="57"><?php echo ($vo["remark"]); ?></textarea>
			</div>
		</div>

		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>

	</div>
</div>