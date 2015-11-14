<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>汁儿</title>
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
<meta content="telephone=no" name="format-detection">
<link rel="stylesheet" href="/Public/static/css/fruit.css">
<!--link rel="stylesheet" href="/Public/static/css/jquery.mobile-1.3.2.min.css"-->
<script src="/Public/static/js/jquery-1.8.3.min.js"></script>
<!-- script src="/Public/static/js/jquery.mobile-1.3.2.min.js"></script -->
<script src="/Public/static/js/fruit.js"></script>
</head>
<body onload="setLocation();" style="padding:0;margin:0;">
	<div data-role="page" id="pageone" data-position="fixed" style="background-color: #000 !important;"> 
		<div data-role="content" style="padding:0;margin:0;">
            <div class="location" id="location_img" style="padding:0;margin:0;background-size:1px;">
				<div class="location-search">
					<input type="text" id="search_location" placeholder="请在联想列表中选择您的写字楼">
					<input type="hidden" id="base_url" value="<?php echo ($baseurl); ?>">
					<div class="location-search-result">
						<a href="/index.php/fruit/index/index" data-ajax="false">直接进入</a>
					</div>
				</div>
				<div class="location-info">为保证饮品的新鲜度 , 当前仅支持北京国贸商圈</div>
			</div>
		</div>
	</div> 
</body>
</html>