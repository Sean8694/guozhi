<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>汁儿</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/zhier/Public/static/css/admin2.css">
<link rel="stylesheet" href="/zhier/Public/static/css/admin.css">
<link rel="stylesheet" href="/zhier/Public/static/css/jquery.mobile-1.3.2.min.css">
<script src="/zhier/Public/static/js/jquery-1.8.3.min.js"></script>
<script src="/zhier/Public/static/js/jquery.mobile-1.3.2.min.js"></script>
<script>

</script>
</head>

<!-- 编辑器 -->
		<link rel="stylesheet" href="/zhier/Public/kindeditor/themes/default/default.css" />
		<script charset="utf-8" src="/zhier/Public/kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="/zhier/Public/kindeditor/lang/zh_CN.js"></script>
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
				<li><a href="/zhier/index.php/Admin/Product" data-ajax="false">返回</a></li>
				</ul>
			</div>
		</div>
		<div data-role="content">
			<form method="post" data-ajax="false" enctype="multipart/form-data" action="/zhier/index.php/Admin/Product/edit/id/<?php echo ($data["fruit_id"]); ?>">
			  <div data-role="fieldcontain">
				<label for="fullname">所属分类：</label>
				<select name="type_id">
					<?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["type_id"]); ?>" <?php if($vo['type_id'] == $product['type_id']): ?>selected='selected'<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<br /><br />
				<label for="fullname">排序(越大越靠前)：</label>
				<select name="order" id="order">
					<option value="10" <?php if($product['order'] == 10): ?>selected='selected'<?php endif; ?> >10</option>
					<option value="9" <?php if($product['order'] == 9): ?>selected='selected'<?php endif; ?> >9</option>
					<option value="8" <?php if($product['order'] == 8): ?>selected='selected'<?php endif; ?> >8</option>
					<option value="7" <?php if($product['order'] == 7): ?>selected='selected'<?php endif; ?> >7</option>
					<option value="6" <?php if($product['order'] == 6): ?>selected='selected'<?php endif; ?> >6</option>
					<option value="5" <?php if($product['order'] == 5): ?>selected='selected'<?php endif; ?> >5</option>
					<option value="4" <?php if($product['order'] == 4): ?>selected='selected'<?php endif; ?> >4</option>
					<option value="3" <?php if($product['order'] == 3): ?>selected='selected'<?php endif; ?> >3</option>
					<option value="2" <?php if($product['order'] == 2): ?>selected='selected'<?php endif; ?> >2</option>
					<option value="1" <?php if($product['order'] == 1): ?>selected='selected'<?php endif; ?> >1</option>
					<option value="-1" <?php if($product['order'] == 1): ?>selected='selected'<?php endif; ?> >售罄</option>
					<option value="0" <?php if($product['order'] == 0): ?>selected='selected'<?php endif; ?> >删除</option>
				</select>
				<br /><br />
				<label for="fullname">首页推荐：</label>
				<select name="recommend" id="recommend">
					<option value="1" <?php if($product['recommend'] == 1): ?>selected='selected'<?php endif; ?> >是</option>
					<option value="0" <?php if($product['recommend'] == 0): ?>selected='selected'<?php endif; ?> >否</option>
				</select>
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
				<br />
				<label for="fullname">列表小图(640*310)：</label>
				<input type="file" name="img_s">
				<img src="/zhier/Public/upload/<?php echo ($product["picbig"]); ?>" height='40px'>
				<br /><br />
				<label for="fullname">详情大图(500*450)：</label>
				<input type="file" name="img_b">
				<img src="/zhier/Public/upload/<?php echo ($product["pic"]); ?>" height='40px'>
				<br /><br />

				<label for="fullname">产品详情：</label>
				<textarea name="detail" style="width:600px;height:400px;visibility:hidden;float:right;" id='fullname'><?php echo ($product["detail"]); ?></textarea>
				<br /><br />
			  </div>
			  <input type='hidden' name='fruit_id' value='<?php echo ($product["fruit_id"]); ?>'>
			  <input type="submit" data-theme="b" value="修改">
			</form>
			<?php if(is_array($addinfo)): $i = 0; $__LIST__ = $addinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a data-role="button" href="/zhier/index.php/Admin/Product/editaddinfo/addid/<?php echo ($vo["id"]); ?>/fruitid/<?php echo ($product["fruit_id"]); ?>">
					<?php echo ($vo["display_order"]); ?>、<?php echo ($vo["name"]); ?> (￥<?php echo ($vo["price"]); ?>)
				</a><?php endforeach; endif; else: echo "" ;endif; ?>
			<a data-role="button"  href="/zhier/index.php/Admin/Product/addaddinfo/fruitid/<?php echo ($product["fruit_id"]); ?>">
				+ 添加附加条件
			</a>
		</div>
	</div> 
</body>
</html>