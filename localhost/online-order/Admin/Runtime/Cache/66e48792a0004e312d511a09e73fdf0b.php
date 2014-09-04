<?php if (!defined('THINK_PATH')) exit();?>
<form id="pagerForm" action="__URL__" method="post">
	<input type="hidden" name="pageNum" value="1"/>
	<input type="hidden" name="account" value="<?php echo ($_REQUEST["account"]); ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="__URL__" method="post">
		<input type="hidden" name="pageNum" value="1"/>
		<div class="searchBar">
			<ul class="searchContent">
				<li>
					<label>关键字：</label>
					<input type="text" name="content" value=""/>
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
				<!--<li><a class="add" href="__URL__/add" target="dialog" mask="true"><span>新增</span></a></li>-->
                 
				<li><a class="edit" href="__URL__/edit/id/{sid_member}" target="dialog" mask="true" warn="请选择评论"><span>编辑</span></a></li>
				<li class="line">line</li>
                <li><a class="delete" href="__URL__/foreverdelete/navTabId/__MODULE__" posttype="string" rel="id" target="selectedTodo" title="确实要删除这些评论吗?"><span>批量删除</span></a></li>
				<li><a class="delete" href="__URL__/foreverdelete/id/{sid_member}/navTabId/__MODULE__" target="navTabTodo" title="你确定要删除吗？" warn="请选择评论"><span>删除</span></a></li>
				
			</ul>
		</div>
<div  layouth="116">
		<table class="list" width="100%" >
			<thead>
			<tr>
            <th width="18" class="left"><div title="" class="gridCol">
            <input type="checkbox" class="checkboxCtrl" group="id"></div></th>
				<th width="60">编号</th>
				<th>会员</th>
                <th>餐馆</th>
				<th>评论时间</th>
                <th>标题</th>
                <th>内容</th>
                <th>星级</th>
                <th>显示</th>
			</tr>
			</thead>
			<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr target="sid_member" rel="<?php echo ($vo['id']); ?>">
                <td class="left"><div><input type="checkbox" value="<?php echo ($vo['id']); ?>" name="id"></div></td>
					<td><?php echo ($vo['id']); ?></td>
					<td><?php echo W('ShowMember',array('id'=>$vo['member_id']));?></td>
                    <td><?php echo W('ShowRestaurant',array('id'=>$vo['restaurant_id']));?></td>
                    
                    <td><?php echo ($vo['create_time']); ?></td>
                    <td><?php echo ($vo['title']); ?></td>
                    <td><?php echo ($vo['content']); ?></td>
                    <td><?php echo ($vo['star']); ?></td>
				<td><img src="/Public/Images/<?php if($vo["status"] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="listTable.toggle(this, '__URL__/setField/field/status/', <?php echo ($vo["id"]); ?>)" /></td>
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