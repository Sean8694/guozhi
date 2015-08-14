<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
		<!--div data-role="header">
			<a href="/zhier/index.php/fruit/index/detail/id/<?php echo ($fruit["fruit_id"]); ?>" data-role="button" data-icon="back" data-transition="slide" data-direction="reverse">返回</a>
			<h1>评论详情</h1>
			<a href="/zhier/index.php/Fruit/Index/index" data-role="button" data-icon="home">首页</a>
		</div-->
		<div data-role="content">
			<div class="myorder-ckpl">
				<?php if(is_array($commentlist)): $i = 0; $__LIST__ = $commentlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="myorder-ckpl-a">
					<div class="myorder-ckpl-c">
						<?php echo ($vo["to_name"]); ?>
					</div>
					
					<div class="myorder-ckpl-r">
					<?php echo ($vo["commend"]); ?>
					<?php if($vo['rcommend'] != '未回复,超人需要点时间'): ?><span>
							<br /><br />
							Re:<?php echo ($vo["rcommend"]); ?>
						</span><?php endif; ?>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
				
			</div>
		</div>
		<div data-role="footer" data-position="fixed"  data-theme="e" data-tap-toggle="false">
			<div data-role="navbar">
				<ul>
				<li><a href="/zhier/index.php/fruit/index/detail/id/<?php echo ($fruit["fruit_id"]); ?>" data-role="button" data-icon="back" data-transition="slide" data-direction="reverse">返回</a></li>
				<li><a href="/zhier/index.php/Fruit/Index/mycar" data-icon="star">购物车<span class='carnum'><?php echo ($carnum); ?></span></a></li>
				<li><a href="/zhier/index.php/home" data-icon="home">个人中心</a></li>
				</ul>
			</div>
		</div>
	</div> 
</body>
</html>