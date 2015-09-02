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
<script src="/Public/static/js/fruit.js"></script>
<div style='display:none;'>
	<img src='/Public/static/images/logo.jpg' />
</div>
</head>
<body>
	<div data-role="page" id="pageone" data-position="fixed"> 
		<div data-role="content" style="padding:0px;margin:0 0 20px 0;">
            <form action="/index.php/Fruit/Index/suborder" name="form1" method="post"  onsubmit="return checkform();" data-ajax="false">
                <div data-role="fieldcontain">
				<div class="check-location">
					<div class="check-location-title">
						配送信息
					</div>
                    <input type="text" placeholder="收货人姓名" name="fname" id="lname" value="<?php echo ($user_add["name"]); ?>">
                    <label><br /></label>
                    <input type="text" placeholder="手机号" name="fmobile" id="fmobile" value="<?php echo ($user_add["mobile"]); ?>">
                    <label><br /></label>
                    <select name="fplace" id="fplace" onchange="clearfdetail('fdetail')">
						<option value="none">国贸地区楼宇选择</option>
						<?php if(is_array($location)): $key = 0; $__LIST__ = $location;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><option <?php if($now_location == $vo['office_id']): ?>selected<?php endif; ?> value="<?php echo ($vo["office_id"]); ?>"><?php echo ($vo["office_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <label><br /></label>
                    <input type="text" placeholder="详细地址" name="fdetail" id="fdetail" value="<?php echo ($user_add["location_detail"]); ?>">
                    <label><br /></label>
					<input type="hidden" name="addid" value="<?php echo ($user_add["add_id"]); ?>">
					<!--select name="fsendtime" id="fsendtime">
						<option value="0">请选择配送时间</option>
						<?php if(is_array($sendtime)): $key = 0; $__LIST__ = $sendtime;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><option value="<?php echo ($vo); ?>">今日 <?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						<?php if(is_array($sendtime2)): $key = 0; $__LIST__ = $sendtime2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><option value="<?php echo ($vo); ?>">明日 <?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select-->
				</div>
				<div class="apartspace"></div>
				<div class="check-order">
					<div class="check-order-title">
						订单信息
					</div>
						<ul class="check-list">
							<?php if(is_array($fruits)): $i = 0; $__LIST__ = $fruits;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li>
								<h2><?php echo ($data["name"]); if($data["fruit_addname"] != ''): ?>&nbsp;[<?php echo ($data["fruit_addname"]); ?>]<?php endif; ?></h2>
								<div class="em">
									<span class="em1">￥ <?php echo ($data["price"]); ?> x <?php echo ($data["buynum"]); ?></span>
									<span class="em2">使用 <?php echo ($data["coupon_num"]); ?> 张咖啡券，减<?php echo ($data["coupon_price"]); ?>元</span>
								</div>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>	
						</ul>
						<?php if($zhierbi > 0): ?><div style="font-size:12px;padding:10px;border:1px solid #ccc;border-radius:5px;margin-bottom:20px;line-height: 32px;">可用<?php echo ($zhierbi); ?>汁儿币，抵<?php echo ($zhierbi); ?>元哦！
								<div style="float:right;">
									<select name="use_zhierbi" id="switch" data-role="slider" >
									  <option value="0"></option>
									  <option value="1"></option>
									</select>
								</div>
							</div>
						<?php else: ?>
							<label><br /></label><?php endif; ?>
					<div onclick="checkform();" class="car-list-submit">
						 货到付款，共￥<?php echo ($price); ?> , 确认下单 
					</div>
				</div>
                </div>
            </form>
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