<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
<script src="/Public/static/js/jquery.lazyload.js"></script>
<script src="/Public/static/js/fruit.js"></script>
<div style='display:none;'>
	<img src='/Public/static/images/logo.jpg' />
</div>
</head>
<body>
	<div data-role="page" id="pageone" data-position="fixed"> 
		<div data-role="content" style="padding:0px;margin:0px;background-color: #fff;">
			<div class="detail">
				<img src="/Public/upload/<?php echo ($fruit["0"]["picbig"]); ?>"/>	
				<h2>
					<span class="name"><?php echo ($fruit["0"]["name"]); ?></span>
					<span class="start"><?php echo ($fruit["0"]["start"]); ?></span>
					<div class="em"><span class="dolor">￥</span><?php echo ($fruit["0"]["price"]); ?></div>
				</h2>
				<h3><?php echo ($fruit["0"]["intro"]); ?></h3>
				<div class="detail_rname"><?php echo ($fruit["0"]["redname"]); ?> <span style="color:red">活动：<?php echo ($gloabl_discount['REASION']); ?>，现价<?php echo ($fruit["0"]["discount_price"]); ?>元</span></div>
				<div class="empl">
					
					<div class="pl"><a href="/index.php/fruit/index/commonlist/id/<?php echo ($fruit["0"]["fruit_id"]); ?>" data-transition="slide"> <?php echo ($comments); ?>人评论/<?php echo ($buys); ?>单</a></div>
				</div>
				<div>
					
					<div class="detail_infoarea">
						<div class="detail_addsel">
							<div class="detail_addinfo" style="color:#ACA8A3">可选项</div>
							<?php if(is_array($fruitadd)): $i = 0; $__LIST__ = $fruitadd;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="detail_addinfo detail_addinfo_check" id="<?php echo ($vo["id"]); ?>"><span style="width: 75%;
    overflow: hidden;
    display: block;float:left;"><?php echo ($vo["name"]); ?></span></div><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php if($fruitaddcount == 0): ?><div class="detail_addinfo detail_addinfo_check" style="background-image:none;">无</div><?php endif; ?>
						</div>
						<div class="detail_pingzi">
							<div style="background:url('/Public/static/images/cup.jpg');background-size: 46px;background-repeat: no-repeat;">
							</div>
						</div>
						<div class="detail_addsel">
							<div class="detail_addinfo" style="color:#ACA8A3">成分</div>
							<div class="detail_addinfo">
								<?php echo ($fruit["0"]["chengfen_bfb_1"]); ?> 
								<span class="detail_addinfo_cf"><?php echo ($fruit["0"]["chengfen_name_1"]); ?></span>
							</div>
							<div class="detail_addinfo">
								<?php echo ($fruit["0"]["chengfen_bfb_2"]); ?> 
								<span class="detail_addinfo_cf"><?php echo ($fruit["0"]["chengfen_name_2"]); ?></span>
							</div>
							<div class="detail_addinfo">
								<?php echo ($fruit["0"]["chengfen_bfb_3"]); ?> 
								<span class="detail_addinfo_cf"><?php echo ($fruit["0"]["chengfen_name_3"]); ?></span>
							</div>
						</div>
					</div>
					
					<div class="empl">
					</div>
					<div class="detail_buy_button">
						<?php if($close == 0): ?><a href="javascript:;" id="addtocar" onclick="addtocar(<?php echo ($fruit["0"]["fruit_id"]); ?>,'/index.php/fruit/index',1)" class="buy">立即购买</a>
							<a href="javascript:;" id="addtocar" onclick="addtocar(<?php echo ($fruit["0"]["fruit_id"]); ?>,'/index.php/fruit/index',0)" class="car">加入购物车</a>
						<?php else: ?>
							<div style="border:1px solid #999;text-align:center;padding:10px 0;margin:0 10px;">店铺休息中，稍后再来吧...</div><?php endif; ?>
					</div>
					<div class="empl" style="height: 0px;border-bottom: 0px;">
					</div>
					<div class="detail_detail">
						<?php echo ($fruit["0"]["detail"]); ?>	
					</div>
				</div>
			</div>
		</div>
		<div data-role="footer" data-position="fixed"  data-theme="e" data-tap-toggle="false">
			<div data-role="navbar">
				<ul>
				<li><a href="/index.php/fruit/index/index" data-icon="grid" data-ajax="false">产品</a></li>
				<li><a href="/index.php/fruit/index/mycar" data-icon="star">购物车<span class='carnum'><?php echo ($carnum); ?></span></a></li>
				<li><a href="/index.php/home" data-icon="home">个人中心</a></li>
				</ul>
			</div>
		</div>
	</div> 
</body>
</html>