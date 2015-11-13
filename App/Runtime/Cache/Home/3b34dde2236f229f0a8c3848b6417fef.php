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
			<ul class="home-list">
				<?php if(is_array($opinion)): $i = 0; $__LIST__ = $opinion;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
					<div><?php echo (date("Y-m-d H:i",$vo["qtime"])); ?></div>
					<div><b>您：</b><?php echo ($vo["question"]); ?></div>
					<div style="margin-top:5px;"><?php echo (date("Y-m-d H:i",$vo["rtime"])); ?></div>
					<div><?php if($vo['answer']): ?><b>汁儿B：</b><?php endif; echo ($vo["answer"]); ?></div>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<form method="post" action="/index.php/home/index/addopinion" name="form_opinion">
				<textarea placeholder="请在此处填写您的意见与建议，我们会尽快收悉并提供反馈，竭诚为您服务！" name="opinion" class="opinion_val"></textarea>
				<div onclick="return checkForm();" class="car-list-submit">
					 提交 
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
	<script>
		function checkForm(){
			var opinion = $(".opinion_val").val();
			if(opinion.length < 1){
				alert('请填写您的意见哦！');
				return false;
			}
			document.form_opinion.submit();
		}
	</script>
</body>
</html>