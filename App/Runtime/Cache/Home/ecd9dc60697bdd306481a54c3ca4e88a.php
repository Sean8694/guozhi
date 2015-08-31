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
		<div data-role="content" style="padding:0px;margin:0 0 20px 0;">
            <form action="/index.php/Home/Index/myinfo" name="form1" method="post" data-ajax="false">
                <div data-role="fieldcontain">
				<div class="check-location">
					<div class="check-location-title">
						配送信息
					</div>
                    <input type="text" placeholder="收货人姓名" name="fname" id="lname" value="<?php echo ($user_add["name"]); ?>">
                    <label><br /></label>
                    <input type="text" placeholder="手机号" name="fmobile" id="fmobile" value="<?php echo ($user_add["mobile"]); ?>">
                    <label><br /></label>
                    <select name="fplace" id="fplace">
						<option value="none">国贸地区楼宇选择</option>
						<?php if(is_array($location)): $key = 0; $__LIST__ = $location;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><option <?php if($user_add['location'] == $vo['office_id']): ?>selected<?php endif; ?> value="<?php echo ($vo["office_id"]); ?>"><?php echo ($vo["office_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <label><br /></label>
                    <input type="text" placeholder="详细地址" name="fdetail" id="fdetail" value="<?php echo ($user_add["location_detail"]); ?>">
                    <label><br /></label>
					<input type="hidden" name="addid" value="<?php echo ($user_add["add_id"]); ?>">
					<div onclick="document.form1.submit();" class="car-list-submit">
						 保存我的信息 
					</div>
				</div>
                </div>
            </form>
		</div>
		<div data-role="footer" data-position="fixed"  data-theme="e" data-tap-toggle="false">
			<div data-role="navbar">
				<ul>
				<li><a href="/index.php/fruit/index" data-icon="grid" data-ajax="false">产品</a></li>
				<li><a href="/index.php/fruit/index/mycar" data-icon="star" >购物车<span id='carnum'><?php echo ($carnum); ?></span></a></li>
				<li><a href="/index.php/home" data-icon="home"  class="ui-btn-active ui-state-persist">个人中心</a></li>
				</ul>
			</div>
		</div>
	</div> 
</body>
</html>