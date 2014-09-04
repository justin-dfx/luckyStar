<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="__URL__" method="post">
			<input type="hidden" name="medium" value="<?php echo ($_REQUEST["medium"]); ?>"/>
            <input type="hidden" name="pageNum" value="<?php echo ($_REQUEST["pageNum"]); ?>"/>
            <input type="hidden" name="numPerPage" value="<?php echo ($_REQUEST["numPerPage"]); ?>" />
            <input type="hidden" name="orderField" value="<?php echo ($_REQUEST["orderField"]); ?>" />
            <input type="hidden" name="orderDirection" value="<?php echo ($_REQUEST["orderDirection"]); ?>" />
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="__URL__" method="post">
        	<input type="hidden" name="pid" value="<?php echo ($_REQUEST['pid']); ?>" />
		<div class="searchBar">
			<ul class="searchContent">
				<li>
					<label>名称：</label>
					<input type="text" name="word" class="medium" value="<?php echo ($_REQUEST['word']); ?>" >
				</li>
                <li>
                <label>分组:</label>
                <select name="group_id">
	                <option <?php if(($_REQUEST['group_id'])  ==  "-1"): ?>selected<?php endif; ?> value="-1">所有</option>
	                <option <?php if(($_REQUEST['group_id'])  ==  "0"): ?>selected<?php endif; ?> value="0">未分组</option>
                <?php if(is_array($groupList)): $i = 0; $__LIST__ = $groupList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option <?php if(($_REQUEST['group_id'])  ==  $key): ?>selected<?php endif; ?> value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                </select>                
                </li>
                <li><label>状态：</label>
                    <select name="status">
                        <option <?php if(($_REQUEST['status'])  ==  "-1"): ?>selected<?php endif; ?> value="-1">所有</option>
                        <option <?php if(($_REQUEST['status'])  ==  "1"): ?>selected<?php endif; ?> value="1">可用</option>
                        <option <?php if(($_REQUEST['status'])  ==  "0"): ?>selected<?php endif; ?> value="0">隐藏</option>
                    </select>
                </li>
			</ul>
			<div class="subBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">查询</button></div></div></li>
				</ul>
			</div>
		</div>
		</form>
	</div>
	
	<div class="pageContent">
		<div class="panelBar">
			<ul class="toolBar">
				<li><a class="add" href="__URL__/add/pid/<?php echo ($_REQUEST['pid']); ?>/level/<?php echo ($_REQUEST['level']); ?>" target="dialog" mask="true"><span>新增</span></a></li>
				<li><a class="delete" href="__URL__/foreverdelete/id/{sid_node}/navTabId/__MODULE__" target="navTabTodo" calback="navTabAjaxMenu" title="你确定要删除吗？" warn="请选择节点"><span>删除</span></a></li>
				<li><a class="edit" href="__URL__/edit/id/{sid_node}" target="dialog" mask="true" warn="请选择节点"><span>修改</span></a></li>
			</ul>
		</div>

<div  layouth="116">
		<table class="list" width="100%" >
			<thead>
			<tr>
				<th width="60" <?php echo orderField('id');?>>编号</th>
				<th width="100" <?php echo orderField('name');?>>名称</th>
				<th <?php echo orderField('title');?>>显示名</th>
				<th width="100" <?php echo orderField('group_id');?>>分组</th>
				<th width="80" <?php echo orderField('sort');?>>排序</th>
				<th width="80" <?php echo orderField('level');?>>level</th>                
				<th width="100" <?php echo orderField('status');?>>状态</th>
				<th width="100" >操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr target="sid_node" rel="<?php echo ($vo['id']); ?>">
					<td><?php echo ($vo['id']); ?></td>
					<td><a href="__URL__/index/pid/<?php echo ($vo['id']); ?>/level/<?php echo ($vo['level']+1); ?>" target="navTab" rel="__MODULE__"><?php echo ($vo['name']); ?></a></td>
					<td>
<span onclick="listTable.edit(this, '__URL__/setField/field/title/', <?php echo ($vo["id"]); ?>)"><?php echo (($vo['title'])?($vo['title']):"无标题"); ?></span>
                    </td>
					<td><?php echo (getNodeGroupName($vo['group_id'])); ?></td>
					<td><span onclick="listTable.edit(this, '__URL__/setField/field/sort/', <?php echo ($vo["id"]); ?>)"><?php echo (($vo['sort'])?($vo['sort']):"无"); ?></span></td>
					<td><span onclick="listTable.edit(this, '__URL__/setField/field/level/', <?php echo ($vo["id"]); ?>)"><?php echo (($vo['level'])?($vo['level']):"无"); ?></span></td>
					<td><img src="/Public/Images/<?php if($vo["status"] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="listTable.toggle(this, '__URL__/setField/field/status/', <?php echo ($vo["id"]); ?>)" /></td>
					<td><a href="__URL__/edit/id/<?php echo ($vo['id']); ?>" target="dialog" mask="true"><span>编辑</span></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
</div>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo ($totalCount); ?>条</span>
			</div>
			<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="10" currentPage="<?php echo ($currentPage); ?>"></div>
		</div>
	</div>
</div>