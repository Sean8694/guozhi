<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>汁儿</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/zhier/Public/static/css/admin2.css">
<link rel="stylesheet" href="/zhier/Public/static/css/admin.css">
<link rel="stylesheet" href="/zhier/Public/static/css/jquery.mobile-1.3.2.min.css">
<script src="/zhier/Public/static/js/jquery-1.8.3.min.js"></script>
<script src="/zhier/Public/static/js/jquery.mobile-1.3.2.min.js"></script>
<script>

</script>
</head>
<body>
	<div data-role="page" id="pageone" data-position="fixed"> 
		<div data-role="header" data-position="fixed">
			<div data-role="navbar">
				<ul>
				<?php if(is_array($list)): $key = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><li><a href="/zhier/index.php/Admin/<?php echo ($vo); ?>" data-ajax="false" <?php if($listnow == $vo): ?>class="ui-btn-active ui-state-persist"<?php endif; ?>><?php echo ($key); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
		<div data-role="content">
			<div data-role="navbar" >
				<!--ul>
				<?php if(is_array($type)): $key = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><li><a href="/zhier/index.php/Admin/User/index/type/<?php echo ($vo["type_id"]); ?>" data-ajax="false" <?php if($typeid == $vo['type_id']): ?>class="ui-btn-active ui-state-persist"<?php endif; ?>><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul-->
			</div>
			<ul class="fruit-list">
				<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!--a href="/zhier/index.php/Admin/User/edit/id/<?php echo ($data["fruit_id"]); ?>" data-ajax="false"-->
				<li>
					<img src="<?php echo ($vo["face"]); ?>" class="admin_product_list_img">	
					<h2 class="admin_product_list_h2">[<?php echo ($vo["name"]); ?>] <?php echo ($data["intro"]); ?></h2>
					<div class="admin_product_list_div">注:<?php echo (date('Y-m-d',$vo["ctime"])); ?> 登:<?php echo (date('Y-m-d',$vo["ltime"])); ?></div>
					<div class="admin_product_list_div">
						共下单 <?php echo ($vo['allbuy']); ?> 次。最近一次是：<?php echo ($vo['lastbuy']); ?>
					</div>
					<div class="admin_product_list_div">
						<?php echo ($vo['office_name']); ?> - <?php echo ($vo['location_detail']); ?>[tel:<?php echo ($vo["mobile"]); ?>]
					</div>
				</li>	
				<!--/a--><?php endforeach; endif; else: echo "" ;endif; ?>	
			</ul>
		</div>
	</div> 
</body>
</html>