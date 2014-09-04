<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
	.page{margin-bottom:20px;}
	.page table{margin:10px auto;}
	.page table tr td{padding:5px 0px;}
	.title{font-weight:bold;text-align:right;}
	.info .left{padding-right:30px;}
	.menu_title{font-weight:bold;text-align:left;}
</style>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="pageHeader" style="text-align:center;">订单基本信息</div>
<div class="page">

	<table>
    	<tr>
        	<td class="title" width="10%">订单号：</td>
            <td class="info left" width="40%"><?php echo ($vo['order_sn']); ?></td>
            <td  class="title" width="10%">下单会员：</td>
            <td  class="info" width="40%"><?php echo W('ShowMember',array(id=>$vo['member_id']));?></td>
        </tr>
        <tr>
        	<td class="title" width="10%">餐馆：</td>
            <td class="info left" width="40%"><?php echo W('ShowRestaurant',array('id'=>$vo['restaurant_id']));?></td>
            <td  class="title" width="10%">下单时间：</td>
            <td  class="info" width="40%"><?php echo (date("Y-m-d H:i:s",$vo['create_time'])); ?></td>
        </tr>
        <tr>
        	<td class="title" width="10%">配送时间：</td>
            <td class="info left" width="40%"><?php if($vo["delivery_time"] == "0"): ?>暂未配送<?php else: ?><?php echo (date("Y-m-d H:i:s",$vo['delivery_time'])); ?><?php endif; ?></td>
            <td  class="title" width="10%">完成时间：</td>
            <td  class="info" width="40%"><?php if($vo["complete_time"] == "0"): ?>暂未完成<?php else: ?><?php echo (date("Y-m-d H:i:s",$vo['complete_time'])); ?><?php endif; ?></td>
        </tr>
         <tr>
        	<td class="title" width="10%">取消时间：</td>
            <td class="info left" width="40%"><?php if($vo["cancel_time"] == "0"): ?>未取消<?php else: ?><?php echo (date("Y-m-d H:i:s",$vo['cancel_time'])); ?><?php endif; ?></td>
           <td class="title" width="10%">支付方式：</td>
            <td class="info" width="40%"><?php if($vo["status"] == '1'): ?>现金支付<?php elseif($vo["status"] == '2'): ?>信用卡支付<?php else: ?>贝宝支付<?php endif; ?></td>
        </tr>
        <tr>
        	
            <td class="title" width="10%">订单状态：</td>
            <td class="info" width="40%">
            		<?php if($vo["status"] == '1'): ?>已下单
                    <?php elseif($vo["status"] == '2'): ?>已下单，已配送
                    <?php elseif($vo["status"] == '3'): ?>已下单，已配送，已完成
                    <?php else: ?>已取消<?php endif; ?>
            </td>
        </tr>
    </table>

</div>
<div class="pageHeader" style="text-align:center;">收货人信息</div>
<div class="page">
	<table>
    	<tr>
        	<td class="title" width="10%">收货人：</td>
            <td class="info" width="40%"><?php echo ($vo['consignee']); ?></td>
            <td  class="title" width="10%">收货地址：</td>
            <td  class="info" width="40%"><?php echo ($vo['address']); ?></td>
        </tr>
           <tr>
        	<td class="title" width="10%">联系电话：</td>
            <td class="info" width="40%"><?php echo ($vo['tel']); ?></td>
            <td  class="title" width="10%">邮箱：</td>
            <td  class="info" width="40%"><?php echo ($vo['email']); ?></td>
        </tr>
    </table>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="pageHeader" style="text-align:center;">菜单信息</div>
<div class="page">
	<table>
    	<tr>
        	<td class="menu_title" width="10%">菜品</td>
            <td class="menu_title" width="30%">口味及增加项目</td>
           
            <td class="menu_title" width="10%">数量</td>
             <td class="menu_title" width="30%">特别说明</td>
            <td class="menu_title" width="10%">小计</td>
        </tr>
        <?php if(is_array($menu_list)): $i = 0; $__LIST__ = $menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): ++$i;$mod = ($i % 2 )?><tr>
        	<td><?php echo ($vol['dishesname']); ?>(<?php echo ($vol['price']); ?>)</td>
            <td><?php echo ($vol['item']); ?></td>
            <td><?php echo ($vol['quantity']); ?></td>
            <td><?php echo ($vol['remark']); ?></td>
             <td>$<?php echo ($vol['total_price']); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
         <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><tr>
         	<td style="font-weight:bold;text-align:right;" colspan="4">合计：</td>
            <td>$<?php echo ($v['total_money']); ?></td>
         </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>