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
	<div data-role="page" id="pageone" data-position="fixed" data-dom-cache="false"> 
		<div data-role="content" style="padding:0px 10px;margin:0 0 20px 0;">
			<?php if($carnum > 0): ?><form action="/index.php/fruit/index/check" name="formcar" method="post">
				<ul class="car-list">
					<span style="display:none"><?php echo ($jishuqi=0); ?></span>
					<?php if(is_array($fruit)): $key = 0; $__LIST__ = $fruit;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($key % 2 );++$key;?><li id="fruit_li_<?php echo ($data["car_id"]); ?>">
						<div class="fruit_li_info"
						<?php if($jishuqi == 3): echo ($jishuqi=0); endif; ?>
						<?php echo ($jishuqi++); ?>
						<?php if($jishuqi == 1): ?>style="background-color: #FF521E;"
						<?php elseif($jishuqi == 2): ?>
							style="background-color: #FFD400;"
						<?php elseif($jishuqi == 3): ?>
							style="background-color: #00CD68;"
						<?php else: ?>
							style="background-color: #FF521E;"<?php endif; ?>
						>
							<!--img src="/Public/upload/<?php echo ($data["pic"]); ?>" onclick="window.open('/index.php/fruit/index/detail/id/1')"/-->	
							<h2>
								<?php echo ($data["name"]); ?>
								<span></span>
							</h2>
							
							<div class="car-number">
								<div class="car-sub" onclick="carSub(<?php echo ($data["car_id"]); ?>)">-</div>
								<div class="car-num" id="fruit_id_<?php echo ($data["car_id"]); ?>"><?php echo ($data["num"]); ?></div>
								<div class="car-add" onclick="carAdd(<?php echo ($data["car_id"]); ?>)">+</div>
								<input type="hidden" name="fruit_num_<?php echo ($data["car_id"]); ?>" id="fruit_num_<?php echo ($data["car_id"]); ?>" value="<?php echo ($data["num"]); ?>">
							</div>
							<div class="em">
								￥ <?php echo ($data["price"]); ?>&nbsp;x&nbsp;
							</div>
						</div>
						<div class="fruit_li_addinfo">
							<?php echo ($data["addinfo"]); ?>
							<span class="car-del" onclick="carDel(<?php echo ($data["car_id"]); ?>,'/index.php/fruit/index',<?php echo ($data["num"]); ?>)">删 除</span>
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>	
				</ul>
				<div style="float:right;width:100%;margin-top:0px;" id="gotoCheck">
					<div onclick="window.open('/index.php/fruit/index/index')" class="car-list-submit-more">
						  继续添加 
					</div>
					<div onclick="document.formcar.submit();" class="car-list-submit">
						 确认选择，去结算 
					</div>
				</div>
				</form>
				<input type="hidden" id="id_carnum" value="<?php echo ($carnum); ?>">
			<?php else: ?>
				<p class="car-empty">
					亲,购物车是空的
				</p>
				<p>
					<div onclick="window.open('/index.php/fruit/index/index')" class="car-list-submit">
						 去选购吧 
					</div>	
				</p><?php endif; ?>
		</div>
		<input type="hidden" id="baseurl" value="<?php echo ($baseurl); ?>">
		<div data-role="footer" data-position="fixed" data-theme="e" data-tap-toggle="false">
			<div data-role="navbar">
				<ul>
				<li><a href="/index.php/fruit/index/index" data-icon="grid" data-ajax="false">产品</a></li>
				<li><a href="/index.php/fruit/index/mycar" data-icon="star" class="ui-btn-active ui-state-persist">购物车<span class='carnum' id="carnum"><?php echo ($carnum); ?></span></a></li>
				<li><a href="/index.php/home" data-icon="home">个人中心</a></li>
				</ul>
			</div>
		</div>
	</div> 
</body>
</html>