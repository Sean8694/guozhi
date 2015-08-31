<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>汁儿</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="telephone=no" name="format-detection">
<link rel="stylesheet" href="/Public/static/css/fruit.css">
<link rel="stylesheet" href="/Public/static/css/jquery.mobile-1.3.2.min.css">
<script src="/Public/static/js/jquery-1.8.3.min.js"></script>
<script src="/Public/static/js/jquery.mobile-1.3.2.min.js"></script>
<script src="/Public/static/js/fruit.js"></script>
<div style='display:none;'>
	<img src='/Public/static/images/logo.jpg' />
</div>
</head>
<body>
	<div data-role="page" id="pageone" data-position="fixed"> 
		<div data-role="content" style="text-align: center;">
			<?php if(($result == 'success') ): ?><img src="/Public/static/images/suborder.gif" style="width: 70px;
margin: 30px;" />
				<p style="margin: auto;
text-align: center;
font-weight: bold;
font-size: 20px;">恭喜,订单已成功提交！</p>
				<p style="text-align: center;
line-height: 30px;
color: #ACA8A3;
font-family: 微软雅黑;
font-size: 14px;">我们将在指定时间内为您配送，<br />您可以在“个人中心”查看您的订单。<br/><br/>
<a href="/index.php/home/index/sharecouponshare/id/<?php echo ($orderid); ?>" data-ajax="false" style="color:red;font-weight:bold;text-decoration:none;">猛戳此处，发红包给好友！</a>
</p>
			<?php else: ?>
				抱歉服务器脑子进水了，请联系客服。<?php endif; ?>
		</div>
		<div data-role="footer" data-position="fixed" data-theme="e" data-tap-toggle="false">
			<div data-role="navbar">
				<ul>
				<li><a href="/index.php/Fruit/Index/index" data-icon="grid" data-ajax="false">产品</a></li>
				<li><a href="/index.php/Fruit/Index/mycar" data-icon="star" class="ui-btn-active ui-state-persist">购物车<span id='carnum'><?php echo ($carnum); ?></span></a></li>
				<li><a href="/index.php/home" data-icon="home">个人中心</a></li>
				</ul>
			</div>
		</div>
	</div> 
</body>
</html>