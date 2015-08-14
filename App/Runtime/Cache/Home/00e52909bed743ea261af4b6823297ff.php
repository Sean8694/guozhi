<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>汁儿</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="telephone=no" name="format-detection">
<link rel="stylesheet" href="/zhier/Public/static/css/fruit.css">
<link rel="stylesheet" href="/zhier/Public/static/css/jquery.mobile-1.3.2.min.css">
<script src="/zhier/Public/static/js/jquery-1.8.3.min.js"></script>
<script src="/zhier/Public/static/js/jquery.mobile-1.3.2.min.js"></script>
<script src="/zhier/Public/static/js/fruit.js"></script>
<div style='display:none;'>
	<img src='/zhier/Public/static/images/logo.jpg' />
</div>
</head>
<body>
	<div data-role="page" id="pageone" data-position="fixed" style="background-color:#fff;"> 
		<div data-role="content" style="background-color:#fff;">
			<div class="home-header">
				<div><?php if($user['face'] == '0'): ?><img src="/zhier/Public/upload/my_head.gif"/><?php else: ?><img src="<?php echo ($user["face"]); ?>"/><?php endif; ?></div>
				<div class="home-header-2"><?php echo ($user["name"]); ?></div>
				<div class="home-header-3"><?php echo ($user["mobile"]); ?></div>
			</div>
			<ul class="home-list">
				<li>
					<a href="/zhier/index.php/Home/Index/myinfo">
						<img src="/zhier/Public/upload/my_zl.gif"/>	
						<h2>我的资料</h2>
						<div class='em'>></div>
						<div class='em'></div>
					</a>
				</li>
				<li>
					<a href="/zhier/index.php/Home/Index/orders" data-ajax="false">
						<img src="/zhier/Public/upload/my_dd.gif"/>	
						<h2>我的订单（<?php echo ($order_num); ?>）</h2>
						<div class='em'>></div>
					</a>
				</li>	
				<li>
					<a href="/zhier/index.php/Home/Index/sharecoupon">
						<img src="/zhier/Public/upload/my_qb.gif"/>	
						<h2>我的汁儿币</h2>
						<div class='em'>></div>
					</a>
				</li>	
				<li>
					<a href="/zhier/index.php/Home/Index/wallet">
						<img src="/zhier/Public/upload/my_qb.gif"/>	
						<h2>我的钱包</h2>
						<div class='em'>></div>
					</a>
				</li>
				<li>
					<a href="/zhier/index.php/Home/Index/opinion">
						<img src="/zhier/Public/upload/my_yj.gif"/>	
						<h2>意见建议（<?php echo ($opinion_num); ?>）</h2>
						<div class='em'>></div>
					</a>
				</li>
				
			</ul>
		</div>
		<div data-role="footer" data-position="fixed"  data-theme="e" data-tap-toggle="false">
			<div data-role="navbar">
				<ul>
				<li><a href="/zhier/index.php/fruit/index" data-icon="grid" >产品</a></li>
				<li><a href="/zhier/index.php/fruit/index/mycar" data-icon="star" >购物车<span id='carnum'><?php echo ($carnum); ?></span></a></li>
				<li><a href="/zhier/index.php/home" data-icon="home"  class="ui-btn-active ui-state-persist">个人中心</a></li>
				</ul>
			</div>
		</div>
	</div> 
</body>
</html>