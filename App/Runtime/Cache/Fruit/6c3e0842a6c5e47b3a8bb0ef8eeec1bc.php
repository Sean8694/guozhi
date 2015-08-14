<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <title>果汁</title>
  <style type="text/css">
  body{
  	color: #5a5a5a;
    font-family: "Microsoft Yahei","Helvetica Neue",Helvetica,Arial,Tahoma,sans-serif;
    font-size: 12px;
    height: auto;
    position: relative;
    text-align: center;
    background: url("./images/closei.png") no-repeat scroll 0 0 #FF6C67;
}
  .parent{
  	width: 100%;
	padding: 300px 0 0 0;
  }
  .title{
  	color:#F6E5E3;
  	padding: 10px 8px;
  }
  .button{
  	width: 140px;
  	height: 50px;
  	border: 1px solid #FFD879;
  	border-radius: 15px;
  	margin: 10px auto;
  	font-size: 18px;
  	color: #FFD879;
  	line-height: 45px;
  	cursor: pointer;
  }
  .shade{
  	/*display: none;*/
  	background: none repeat scroll 0 0 rgba(0, 0, 0, 0.6);
  	height: 100%;
    position: fixed;
    top: 0;
    width: 100%;
    margin-left: -8px;
  }
  .hbshade{
  	color:#F6E5E3; 
  	background-color: #F85033;
    border-radius: 5px;
    margin: 47% auto;
    height: 180px;
    padding: 20px 20px 0;
    text-align: center;
    width: 70%;
  }
  .hb_button{
  	border-radius: 5px;
  	background-color: #FFB121;
  	font-size: 18px;
  	font-weight: bold;
  	color: #FF822B;
  	cursor: pointer;
  	margin: 50px auto;
  	width: 200px;
  	height: 50px;
  	line-height: 45px;
  }
  </style>
 </head>
 <body>
  	<div class="parent">
  		<div class="title"><?php echo ($coupon["title"]); ?><br />红包剩余<?php echo ($coupon["left"]); ?>个，还不快抢！</div>
  		<div class="button" onclick="gethb();">
			<a style="text-decoration:none;color:#FFD879" href="/zhier/index.php/Fruit/ShareCoupon/get/id/<?php echo ($coupon["id"]); ?>/t/<?php echo ($coupon["ctime"]); ?>" data-ajax='false'>领取红包</a>
		</div>
  	</div>
	<div class="shade">
		<div class="hbshade">
			<?php if($echo > 0): ?><h2>恭喜您，获得了 <?php echo ($echo); ?> 元汁儿币，已存入您的账户！</h2>
				<div class="hb_button" onclick="window.open('/zhier/index.php/home/index/sharecoupon')">
					<a href="/zhier/index.php/home/index/sharecoupon" data-ajax="false" style="text-decoration:none;color:#ff3300">查&nbsp;&nbsp;&nbsp;看</a>
				</div>
			<?php elseif($echo == 0): ?>
				<h2>手慢一步，优惠券被领取光啦，关注我们，机会多多哦！</h2>
			<?php elseif($echo == -1): ?>
				<h2>您没有授权微信登录，无法领取！请通过微信访问本链接。</h2>
			<?php elseif($echo == -2): ?>
				<h2>您已经领取过啦！</h2>
				<div class="hb_button" onclick="window.open('/zhier/index.php/home/index/sharecoupon')">
					<a href="/zhier/index.php/home/index/sharecoupon" data-ajax="false" style="text-decoration:none;color:#ff3300">查&nbsp;&nbsp;&nbsp;看</a>
				</div><?php endif; ?>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
function gethb(){
	$(".shade").show();
}
</script>
 </body>
</html>