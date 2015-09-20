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

<!-- 编辑器 -->
		<link rel="stylesheet" href="/Public/kindeditor/themes/default/default.css" />
		<script charset="utf-8" src="/Public/kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="/Public/kindeditor/lang/zh_CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="detail"]', {
					allowFileManager : true
				});
				K('input[name=getHtml]').click(function(e) {
					alert(editor.html());
				});
				K('input[name=isEmpty]').click(function(e) {
					alert(editor.isEmpty());
				});
				K('input[name=getText]').click(function(e) {
					alert(editor.text());
				});
				K('input[name=selectedHtml]').click(function(e) {
					alert(editor.selectedHtml());
				});
				K('input[name=setHtml]').click(function(e) {
					editor.html('<h3>Hello KindEditor</h3>');
				});
				K('input[name=setText]').click(function(e) {
					editor.text('<h3>Hello KindEditor</h3>');
				});
				K('input[name=insertHtml]').click(function(e) {
					editor.insertHtml('<strong>插入HTML</strong>');
				});
				K('input[name=appendHtml]').click(function(e) {
					editor.appendHtml('<strong>添加HTML</strong>');
				});
				K('input[name=clear]').click(function(e) {
					editor.html('');
				});
			});
		</script>
<!-- 编辑器 -->

<body>
	<div data-role="page" id="pageone" data-position="fixed"> 
		<div data-role="header" data-position="fixed">
			<div data-role="navbar">
				<ul>
				<li><a href="/index.php/Admin/Product" data-ajax="false">返回</a></li>
				</ul>
			</div>
		</div>
		<div data-role="content">
			<form method="post" data-ajax="false" enctype="multipart/form-data" action="/index.php/Admin/Product/add">
			  <div data-role="fieldcontain">
				<label for="fullname">所属分类：</label>
				<select name="type_id">
					<?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["type_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<br /><br />
				<label for="fullname">排序(越大越靠前,0为删除，-1为售罄)：</label>
				<input type="text" name="order" id="fullname" value="<?php echo ($product["order"]); ?>">   
				<br /><br />
				<label for="fullname">产品简称：</label>
				<input type="text" name="name" id="fullname" value="<?php echo ($product["name"]); ?>">   
				<br /><br />
				<label for="fullname">简介全称：</label>
				<input type="text" name="intro" id="fullname" value="<?php echo ($product["intro"]); ?>">
				<br /><br />
				<label for="fullname">价钱：</label>
				<input type="text" name="price" id="fullname" placeholder="" value="<?php echo ($product["price"]); ?>">
				<br /><br />
				<label for="fullname">销量：</label>
				<input type="text" name="buys" id="fullname" placeholder="" value="<?php echo ($product["buys"]); ?>">
				<br /><br />
				<label for="fullname">红色提示：</label>
				<input type="text" name="redname" id="fullname" placeholder="" value="<?php echo ($product["redname"]); ?>">

				<br /><br />
				<label for="fullname">成分1：</label>
				<input type="text" name="chengfen_name_1" id="chengfen_name_1" placeholder="" value="<?php echo ($product["chengfen_name_1"]); ?>">
				<label for="fullname">值1：</label>
				<input type="text" name="chengfen_bfb_1" id="chengfen_bfb_1" placeholder="" value="<?php echo ($product["chengfen_bfb_1"]); ?>">
				<br /><br />
				<label for="fullname">成分2：</label>
				<input type="text" name="chengfen_name_2" id="chengfen_name_2" placeholder="" value="<?php echo ($product["chengfen_name_2"]); ?>">
				<label for="fullname">值2：</label>
				<input type="text" name="chengfen_bfb_2" id="chengfen_bfb_2" placeholder="" value="<?php echo ($product["chengfen_bfb_2"]); ?>">
				<br /><br />
				<label for="fullname">成分3：</label>
				<input type="text" name="chengfen_name_3" id="chengfen_name_3" placeholder="" value="<?php echo ($product["chengfen_name_3"]); ?>">
				<label for="fullname">值3：</label>
				<input type="text" name="chengfen_bfb_3" id="chengfen_bfb_3" placeholder="" value="<?php echo ($product["chengfen_bfb_3"]); ?>">
				<br /><br />
				<label for="fullname">详情(500*450|JPG格式)：</label>
				<input type="file" name="img_s">
				<br /><br />
				<label for="fullname">列表(640*310|JPG格式)：</label>
				<input type="file" name="img_b">
				<br /><br />

				<label for="fullname">产品详情：</label>
				<textarea name="detail" style="width:600px;height:400px;visibility:hidden;float:right;" id='fullname'><?php echo ($product["detail"]); ?></textarea>
				<br /><br />
			  </div>
			  <input type="submit" data-theme="b" value="添加">
			</form>
		</div>
	</div> 
</body>
</html>