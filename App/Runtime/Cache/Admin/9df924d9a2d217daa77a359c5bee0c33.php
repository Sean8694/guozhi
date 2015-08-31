<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>汁儿</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Public/static/css/admin2.css">
<link rel="stylesheet" href="/Public/static/css/admin.css">
<link rel="stylesheet" href="/Public/static/css/jquery.mobile-1.3.2.min.css">
<script src="/Public/static/js/jquery-1.8.3.min.js"></script>
<script src="/Public/static/js/jquery.mobile-1.3.2.min.js"></script>
<script>

</script>
</head>
<script>
	function changeStatus(orderid,tostatus){
		var filter	= <?php echo ($filter); ?>;
		if( tostatus < filter ){
			if(confirm("你要回退吗？")){
			}else{
				return false;
			}
		}
		// 发送Ajax请求，成功后隐藏这条记录
		$(document).load("/index.php/Admin/Index/changestatus/orderid/"+orderid+"/tostatus/"+tostatus,function(responseTxt,statusTxt,xhr){
			// 购物车提示信息
			$.mobile.loading('show', {  
				textVisible: true, //是否显示文字  
				theme: 'a',        //加载器主题样式a-e  
				textonly: false,   //是否只显示文字  
				html: ""           //要显示的html内容，如图片等  
			});
			if(statusTxt=="success"){
				// 返回的是购物车的商品数量
				if( responseTxt>0 ){
					setTimeout("hiddenLoading()",1); 
					$('#order_'+orderid).slideUp('slow'); 
				}
			}
			if(statusTxt=="error"){
				alert("失败，请重试。");
			}
		});
	}
	// 清除提示信息
    function hiddenLoading(){
        $.mobile.loading('hide','normal');
    }
	// 声音提示
	$(function(){ 
		$("#chatData").focus();
		$('<audio id="chatAudio"><source src="/Public/static/notify.ogg" type="audio/ogg"><source src="/Public/static/notify.mp3" type="audio/mpeg"><source src="/Public/static/notify.wav" type="audio/wav"></audio>').appendTo('body');

		$("#havenew").ready(function(){
			if(document.getElementById('havenew').innerHTML == 2){
				$('#chatAudio')[0].play();
				// 有新的订单,就不刷新了
				//alert('有新的订单，');
			}else{
				setTimeout("window.location.reload()",60000); 
			}
		});
	});

</script>

<body>
	<div data-role="page" id="pageone" data-position="fixed"> 
		<div data-role="header" data-position="fixed">
				<div data-role="navbar">
					<ul>
					<?php if(is_array($list)): $key = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><li><a href="/index.php/Admin/<?php echo ($vo); ?>" data-ajax="false" <?php if($listnow == $vo): ?>class="ui-btn-active ui-state-persist"<?php endif; ?>><?php echo ($key); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
		</div>
		<div data-role="content">
			<div data-role="navbar">
				<ul>
				<li><a href="/index.php/Admin/Index/index/filter/1" data-ajax="false" <?php if($filter == 1): ?>class="ui-btn-active ui-state-persist"<?php endif; ?>>已下单</a></li>
				<li><a href="/index.php/Admin/Index/index/filter/2" data-ajax="false" <?php if($filter == 2): ?>class="ui-btn-active ui-state-persist"<?php endif; ?>>制作中</a></li>
				<li><a href="/index.php/Admin/Index/index/filter/3" data-ajax="false" <?php if($filter == 3): ?>class="ui-btn-active ui-state-persist"<?php endif; ?>>配送中</a></li>
				<li><a href="/index.php/Admin/Index/index/filter/4" data-ajax="false" <?php if($filter == 4): ?>class="ui-btn-active ui-state-persist"<?php endif; ?>>已送达</a></li>
				<li><a href="/index.php/Admin/Index/index/filter/5" data-ajax="false" <?php if($filter == 5): ?>class="ui-btn-active ui-state-persist"<?php endif; ?>>已退单</a></li>
				</ul>
			</div>
			<ul class="myorder-list">
			<?php if($filter == 1): if($order_list_count != 0): ?><div id="havenew" style="display:none;">2</div>
				<?php else: ?>
					<div id="havenew" style="display:none;">0</div><?php endif; endif; ?>
				<?php if(is_array($order_list)): $key = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><li id="order_<?php echo ($vo["order_id"]); ?>" <?php if($key%2 == 1): ?>style="background-color:#d7ffd7"<?php endif; ?>>
					<div class="myorder-list-info-1">
						<div class="myorder-list-info-status">
							<?php echo ($vo["status"]); if($vo['detail_num'] == 1): ?><font color="red">【首单】</font><?php else: ?>【<?php echo ($vo["detail_num"]); ?>】<?php endif; ?>
						</div>
						<div class="myorder-list-info-id">
							订单号:<?php echo ($vo["order_id"]); ?>	
						</div>
					</div>
					<div class="myorder-list-info-2">
						<?php echo ($vo["to_location"]); ?><br /><?php echo ($vo["to_location_detail"]); ?>
						<br />
						<?php echo ($vo["to_name"]); ?>【<?php echo ($vo["to_mobile"]); ?>】
						<br />
						下单时间：<?php echo ($vo["ctime"]); ?>
						<br />
						已过时间：<?php echo ($vo["ptime"]); ?> 分
					</div>
					<div class="myorder-list-info-3">
						<?php echo ($vo["detail"]); ?>
					</div>
					<div class="myorder-list-info-4">
						订单总额:￥<?php echo ($vo["price"]); ?>
					</div>
					<div class="myorder-list-info-4">
						<div data-role="controlgroup" data-type="horizontal">
						<?php if($filter != 1): ?><div data-role="button" onclick="changeStatus(<?php echo ($vo["order_id"]); ?>,1)">已下单</div><?php endif; ?>
						<?php if($filter != 2): ?><div data-role="button" onclick="changeStatus(<?php echo ($vo["order_id"]); ?>,2)">制作中</div><?php endif; ?>
						<?php if($filter != 3): ?><div data-role="button" onclick="changeStatus(<?php echo ($vo["order_id"]); ?>,3)">配送中</div><?php endif; ?>
						<?php if($filter != 4): ?><div data-role="button" onclick="changeStatus(<?php echo ($vo["order_id"]); ?>,4)">已送达</div><?php endif; ?>
						<?php if($filter != 5): ?><div data-role="button" onclick="changeStatus(<?php echo ($vo["order_id"]); ?>,5)">已退单</div><?php endif; ?>
						</div>
					</div>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>

	</div> 
</body>
</html>