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
				<?php if(is_array($order_list)): $key = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><li>
					<span style="display:none;"><?php echo ($color = $key%2); ?></span>
					<div class="myorder-list-info-1" <?php if($color == 1): ?>style="background-color:#68b4ff;"<?php endif; ?>>
						
						<div class="myorder-list-info-status">
							<?php echo ($vo["ctime"]); ?>
						</div>
						<div class="myorder-list-info-id">
							订单号:<?php echo ($vo["order_id"]); ?>	
						</div>
					</div>
					<div class="myorder-list-info-2">
						<?php echo ($vo["to_name"]); ?> , <?php echo ($vo["to_mobile"]); ?>
						<br />
						配送地址：<?php echo ($vo["to_location"]); ?> <?php echo ($vo["to_location_detail"]); ?>
						<!--
						<br />
						约定配送：当日 <?php echo ($vo["sendtime"]); ?> 点-->
					</div>
					<div class="myorder-list-info-3">
						<?php if($vo['coupon'] != ''): ?><div>共使用：<?php echo ($vo["coupon"]); ?></div><?php endif; ?>
						<?php echo ($vo["detail"]); ?>
					</div>
					<div class="myorder-list-info-4">
						<div class="myorder-list-info-price">
							订单总额：<span class="s1">￥<?php echo ($vo["price"]); ?></span>
							<?php if($vo['iscommend'] == 0): if($vo['statusold'] == 4): ?><div class="myorder-gotockpl" style="margin-left:10px;border-color:#ff3300;">
										<a href="/index.php/home/index/sharecouponshare/id/<?php echo ($vo["order_id"]); ?>" data-ajax="false" style="color:#ff3300">发红包</a>
									</div>
									<div class="myorder-gotopl">
										<a href="/index.php/home/index/comment/id/<?php echo ($vo["order_id"]); ?>" style="color:#F15353">
											去评论
										</a>
									</div>
									
								<?php else: ?>
									<span class="s2"><?php echo ($vo["status"]); ?></span><?php endif; ?>
							<?php else: ?>
								<div class="myorder-gotockpl" style="margin-left:10px;border-color:#ff3300;"> 
									<a href="/index.php/home/index/sharecouponshare/id/<?php echo ($vo["order_id"]); ?>" data-ajax="false" style="color:#ff3300">发红包</a>
								</div>
								<div class="myorder-gotockpl">
									<a href="/index.php/home/index/comment/id/<?php echo ($vo["order_id"]); ?>" style="color:#009900">查看评论</a>
								</div><?php endif; ?>
						</div>
					</div>
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