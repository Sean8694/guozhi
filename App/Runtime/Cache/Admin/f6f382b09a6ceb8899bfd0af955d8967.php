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
				<li><a href="/zhier/index.php/Admin/ShareCoupon" data-ajax="false">返回</a></li>
				</ul>
			</div>
		</div>
		<div data-role="content">
			<form method="post" data-ajax="false" enctype="multipart/form-data" action="/zhier/index.php/Admin/ShareCoupon/add">
			  <div data-role="fieldcontain">
				<label for="fullname">标题：</label>
				<input type="text" name="title" id="fullname" value="<?php echo ($product["order"]); ?>">   
				<br /><br />
				<label for="fullname">总计数量：</label>
				<input type="text" name="num" id="fullname" value="<?php echo ($product["name"]); ?>">   
				<br /><br />
				<label for="fullname">单个金额：</label>
				<input type="text" name="value" id="fullname" value="<?php echo ($product["intro"]); ?>">
			  </div>
			  <input type="submit" data-theme="b" value="添加">
			</form>
		</div>
	</div> 
</body>
</html>