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
			<ul class="fruit-list">
				<?php if(is_array($coupons)): $i = 0; $__LIST__ = $coupons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>发布时间：<?php echo ($vo["ctime"]); ?> | 
					总计数量：<?php echo ($vo["num"]); ?> | 
					领取数量：<?php echo ($vo["used"]); ?> | 
					单个金额：<?php echo ($vo["value"]); ?> | 
					<a href="/zhier/index.php/fruit/ShareCoupon/index/id/<?php echo ($vo["id"]); ?>" target='_blank'><?php echo ($vo["title"]); ?></a>
					<hr/><?php endforeach; endif; else: echo "" ;endif; ?>	
			</ul>
			<a href="/zhier/index.php/Admin/ShareCoupon/add" data-role="button" data-inline="true" data-theme="b" data-ajax="false">+ 添加分享卷</a>
		</div>
	</div> 
</body>
</html>