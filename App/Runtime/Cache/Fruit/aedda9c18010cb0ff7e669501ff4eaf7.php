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
<body onload="setDetail()">
	<div data-role="page" id="pageone" data-position="fixed"> 
		<div data-role="content" style="padding:0px;background-color:#fff;">
		<!--p style="border:1px dashed #1bbc9b;color:#666;padding:4px;font-size:14px;">冰爽鲜切水果，只需8元起！无配送费。</p-->
			<div class="fruit-list-type">
				<a href="/index.php/Fruit/Index" data-ajax="false"<?php if($selected == 'recommend'): ?>class="selected"<?php endif; ?> >今日推荐</a>
				<?php if(is_array($type)): $key = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><a href="/index.php/Fruit/Index/index/type/<?php echo ($vo["type_id"]); ?>" data-ajax="false"<?php if($selected == $vo['type_id']): ?>class="selected"<?php endif; ?>>
					<?php echo ($vo["name"]); ?>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<ul class="fruit-list">
				<?php if(is_array($fruit)): $i = 0; $__LIST__ = $fruit;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($data['order'] == '-1'): else: ?>	
				<a href="/index.php/Fruit/Index/detail/id/<?php echo ($data["fruit_id"]); ?>" data-ajax="false"><?php endif; ?>
				<li class="fruit-list-li" style="background:url('/Public/upload/<?php echo ($data["pic"]); ?>');background-size: cover;"
				<?php if($data['order'] == '-1'): ?>onclick="alert('今日已售罄,看看别的吧~')"<?php endif; ?>
				>
					<!--img src="/Public/upload/<?php echo ($data["pic"]); ?>"/-->	
					<h2>&nbsp;<!--{$data.name}--> <?php if($data['order'] == '-1'): ?><span style="font-size:16px;">今日售罄</span><?php endif; ?></h2>
					<h3>&nbsp;<!--{$data.intro}--></h3>
					<div><!--<?php echo ($data["start"]); ?>--> <span>已售<?php echo ($data["buys"]); ?>份</span></div>
					<em><span>￥</span> <?php echo ($data["price"]); ?></em>
					
				</li>	
				<?php if($data['order'] == '-1'): else: ?>
					</a><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
			</ul>
		</div>
		<div data-role="footer" data-position="fixed" data-theme="e" data-tap-toggle="false">
			<div data-role="navbar">
				<ul>
				<li><a href="/index.php/Fruit/Index/index" data-icon="grid" class="ui-btn-active ui-state-persist" data-ajax="false">产品</a></li>
				<li><a href="/index.php/Fruit/Index/mycar" data-icon="star">购物车<span id='carnum'><?php echo ($carnum); ?></span></a></li>
				<li><a href="/index.php/home" data-icon="home">个人中心</a></li>
				</ul>
			</div>
		</div>
	</div> 
</body>
</html>