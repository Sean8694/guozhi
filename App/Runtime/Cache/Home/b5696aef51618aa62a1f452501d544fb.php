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
			<ul class="myorder-list">
				<?php if(is_array($coupons)): $key = 0; $__LIST__ = $coupons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><li>
					<a href="/index.php/Home/Index/walletCoupon/typeid/<?php echo ($vo["type_id"]); ?>" class="my-coupon-all"
					style="<?php if($key == 1): ?>background-color:#00CC67;<?php elseif($key == 2): ?>background-color:#4DB0E8;<?php else: ?>background-color:#FFB53D;<?php endif; ?>"
					>
						<div class="my-coupon-all-num">
							<?php echo ($vo["type_count"]); ?> <span>张</span>
						</div>
						<div class="my-coupon-all-name">
							<?php echo ($vo["coupon_name"]); ?>
							<span>
								点击查看我的优惠券
							</span>
						</div>
					</a>
					<a class="my-coupon-all-more" href="/index.php/Home/Index/walletGetmore/typeid/<?php echo ($vo["type_id"]); ?>">
							获得更多 >
					</a>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
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