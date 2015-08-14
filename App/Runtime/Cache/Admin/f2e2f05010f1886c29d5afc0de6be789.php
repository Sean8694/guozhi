<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>鲜果超人</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/fruit/Public/static/css/fruit.css">
<link rel="stylesheet" href="/fruit/Public/static/css/jquery.mobile-1.3.2.min.css">
<script src="/fruit/Public/static/js/jquery-1.8.3.min.js"></script>
<script src="/fruit/Public/static/js/jquery.mobile-1.3.2.min.js"></script>
<script>

</script>
</head>
<body>
	<div data-role="page" id="pageone" data-position="fixed"> 
		<div data-role="header">
			<div data-role="navbar">
				<ul>
				<?php if(is_array($list)): $key = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><li><a href="/fruit/index.php/Admin/<?php echo ($vo); ?>" data-ajax="false" <?php if($filter == 1): ?>class="ui-btn-active ui-state-persist"<?php endif; ?>><?php echo ($key); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
	</div> 
</body>
</html>