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
		<div data-role="content">
			<?php echo ($types["coupon_name"]); ?>
			<ul class="myorder-list">
			<?php if($coupons): if(is_array($coupons)): $i = 0; $__LIST__ = $coupons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="padding:4%;width:92%">
					汁儿币：<?php echo ($vo["value"]); ?> 元，下单时自动使用。
					<br />
					获得日期：<?php echo ($vo["get_time"]); ?>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php else: ?>
				您的汁儿币已用光...<br />没关系，继续关注我们，机会多多！<?php endif; ?>
			</ul>
		</div>
		<div data-role="footer" data-position="fixed" data-theme="e" data-tap-toggle="false">
			<div data-role="navbar">
				<ul>
				<li><a href="/index.php/fruit/index" data-icon="grid" data-ajax="false">产品</a></li>
				<li><a href="/index.php/fruit/index/mycar" data-icon="star">购物车<span id='carnum'><?php echo ($carnum); ?></span></a></li>
				<li><a href="/index.php/home" data-icon="home" class="ui-btn-active ui-state-persist">个人中心</a></li>
				</ul>
			</div>
		</div>
	</div> 
</body>
</html>