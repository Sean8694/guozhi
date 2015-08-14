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
	<div data-role="page" id="pageone" data-position="fixed"> 
		<div data-role="content">
			<ul class="myorder-list">
				<?php if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
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
					</div>
					<div class="myorder-list-info-4">
						<div class="myorder-list-info-price">
							订单总额：<span class="s1">￥<?php echo ($vo["price"]); ?></span>
							<?php if($vo['iscommend'] == 0): if($vo['statusold'] == 4): ?><div class="myorder-gotopl">
										<a href="/zhier/index.php/home/index/comment/id/<?php echo ($vo["order_id"]); ?>" style="color:#F15353">
											去评论
										</a>
									</div>
								<?php else: ?>
									<span class="s2"><?php echo ($vo["status"]); ?></span><?php endif; ?>
							<?php else: endif; ?>
						</div>
					</div>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<?php if($vo['iscommend'] == 0): ?><div class="myorder-pl">
						<form method="post" action="/zhier/index.php/home/index/addcomment" name='form1'>
							<?php if(is_array($fruit_list)): $i = 0; $__LIST__ = $fruit_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><br />
							<b><?php echo ($vo["fruit_name"]); ?></b>
							<input type="hidden" value="<?php echo ($vo["order_id"]); ?>" name="orderid">
							<textarea placeholder="长度在10~100之间，期待您的评论..." name="comment_<?php echo ($vo["order_detail_id"]); ?>"></textarea><?php endforeach; endif; else: echo "" ;endif; ?>
							<br />
							<div onclick="document.form1.submit();" class="car-list-submit">
								 提交评论 
							</div>
						</form>
					</div>
					
				
			<?php else: ?>
				<div class="myorder-ckpl">
					<?php if(is_array($fruit_list)): $i = 0; $__LIST__ = $fruit_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="myorder-ckpl-c">
						[<?php echo ($vo["fruit_name"]); ?>]
					</div>
					<div class="myorder-ckpl-c">
						<b>评论:</b>
						<?php echo ($vo["commend"]); ?>
					</div>
					<div class="myorder-ckpl-r">
						<b>回复:</b>
						
							<?php echo ($vo["rcommend"]); ?>
						
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div><?php endif; ?>
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