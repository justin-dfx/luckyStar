<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="__URL__" method="post">
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
					<label>用户名：</label>
					<input type="text" name="account" value=""/>
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
				<li><a class="add" href="__URL__/add" target="dialog" mask="true"><span>新增</span></a></li>
				<li><a class="edit" href="__URL__/edit/id/{sid_member}" target="dialog" mask="true" warn="请选择会员"><span>编辑</span></a></li>
                <li><a class="delete" href="__URL__/foreverdelete/id/{sid_member}/navTabId/__MODULE__" target="navTabTodo" title="你确定要删除吗？" warn="请选择会员"><span>删除</span></a></li>
				<li class="line">line</li>
                <li><a class="add" href="<?php echo U('RestaurantDetails/add');?>/restaurant_id/{sid_member}" target="dialog" mask="true"><span>新增详情</span></a></li>
                <li><a class="edit" href="<?php echo U('RestaurantDetails/edit');?>/restaurant_id/{sid_member}" target="dialog" mask="true" warn="请选择会员"><span>编辑详情</span></a></li>
				<li><a class="icon" href="__URL__/password/id/{sid_member}" target="dialog" mask="true" warn="请选择会员"><span>修改密码</span></a></li>
			</ul>
		</div>
<div  layouth="116">
		<table class="list" width="100%" >
			<thead>
			<tr>
				<th width="60">编号</th>
				<th width="100">用户名</th>
                <th>姓名</th>
                <th>联系电话</th>
				<th>餐馆名字</th>
				<th>餐馆电话</th>
                <th>餐馆传真</th>
                <th>地址</th>
				<th>创建时间</th>
				<th>登录次数</th>
				<th>状态</th>
                <th>营业状态</th>
			</tr>
			</thead>
			<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr target="sid_member" rel="<?php echo ($vo['id']); ?>">
					<td><?php echo ($vo['id']); ?></td>
					<td><?php echo ($vo['account']); ?></td>
                    <td><?php echo ($vo['name']); ?></td>
                    <td><?php echo ($vo['phone']); ?></td>
					<td><?php echo ($vo['nickname']); ?></td>
					<td><?php echo ($vo['tel']); ?></td>
                    <td><?php echo ($vo['resfax']); ?></td>
                    <td><?php echo ($vo['address']); ?></td>
					<td><?php echo (date("Y-m-d H:i:s",$vo['create_time'])); ?></td>
					<td><?php echo ($vo['login_count']); ?></td>
					<td><?php echo (showStatus($vo['status'],$vo['id'])); ?></td>
                    <td><a href="__URL__/BusinessStatus/id/<?php echo ($vo['id']); ?>/navTabId/__MODULE__" target='navTabTodo'><?php if($vo["business_status"] == 0): ?>开始营业<?php else: ?>暂停营业<?php endif; ?></a></td>
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