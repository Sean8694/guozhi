<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>汁儿</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Public/static/css/admin2.css">
<link rel="stylesheet" href="/Public/static/css/admin.css">
<link rel="stylesheet" href="/Public/static/css/jquery.mobile-1.3.2.min.css">
<script src="/Public/static/js/jquery-1.8.3.min.js"></script>
<script src="/Public/static/js/jquery.mobile-1.3.2.min.js"></script>
<script>

</script>
</head>
<body>
	<div data-role="page" id="pageone" data-position="fixed"> 
		<div data-role="header" data-position="fixed">
			<div data-role="navbar">
				<ul>
				<?php if(is_array($list)): $key = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><li><a href="/index.php/Admin/<?php echo ($vo); ?>" data-ajax="false" <?php if($listnow == $vo): ?>class="ui-btn-active ui-state-persist"<?php endif; ?>><?php echo ($key); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
		<div data-role="content">
			<div data-role="navbar" >
				<ul>
				<?php if(is_array($opinionstatus)): $key = 0; $__LIST__ = $opinionstatus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><li><a href="/index.php/Admin/Recommend/index/status/<?php echo ($vo["status"]); ?>" data-ajax="false" <?php if($statusnow == $vo['status']): ?>class="ui-btn-active ui-state-persist"<?php endif; ?>><?php echo ($vo["statusname"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<ul class="fruit-list">
				<?php if(is_array($opinion)): $i = 0; $__LIST__ = $opinion;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/index.php/Admin/Recommend/edit/id/<?php echo ($vo["order_detail_id"]); ?>" data-ajax="false">
				<li class="admin_recommend_list_li">
					<h2 class="admin_recommend_list_h2"><?php echo (date('Y-m-d H-i',$vo["ctime"])); ?>[<?php echo ($vo["fruit_name"]); ?>] 
					<br />
					<?php echo ($vo["to_name"]); ?> (<?php echo ($vo["to_mobile"]); ?>)</h2>
					<em class="admin_recommend_list_em">用户: <?php echo ($vo["commend"]); ?></em>
					<div class="admin_recommend_list_div">回复：<?php echo ($vo["rcommend"]); ?></div>
				</li>	
				</a><?php endforeach; endif; else: echo "" ;endif; ?>	
			</ul>
		</div>
	</div> 
</body>
</html>