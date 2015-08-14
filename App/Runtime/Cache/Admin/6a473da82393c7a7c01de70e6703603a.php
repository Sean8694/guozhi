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
				<li><a href="/zhier/index.php/Admin/Product/edit/id/<?php echo ($fruitid); ?>" data-ajax="false">返回</a></li>
				</ul>
			</div>
		</div>
		<div data-role="content">
			<?php echo ($msg); ?>
			<?php if($msg == ''): ?><form method="post" data-ajax="false" enctype="multipart/form-data" action="/zhier/index.php/Admin/Product/addaddinfo/<?php echo ($fruitid); ?>">
				<input name="name" placeholder="名称">
				<input name="price" placeholder="价钱">
				<input name="fruit_id" type="hidden" value="<?php echo ($fruitid); ?>">
				<input name="display_order" placeholder="排序(越大越靠前，0为删除)">
			  <input type="submit" data-theme="b" value="修改">
			</form><?php endif; ?>

</body>
</html>