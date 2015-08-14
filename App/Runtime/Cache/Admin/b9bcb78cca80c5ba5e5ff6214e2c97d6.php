<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>鲜果超人</title>
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
				<li><a href="/zhier/index.php/Admin/Opinion" data-ajax="false">返回</a></li>
				</ul>
			</div>
		</div>
		<div data-role="content">
			<form method="post" data-ajax="false" enctype="multipart/form-data" action="/zhier/index.php/Admin/Opinion/edit/id/<?php echo ($data["fruit_id"]); ?>">
			  <div data-role="fieldcontain">
				<label for="fullname">用户：<?php echo ($opinion["name"]); ?></label>
				<br /><br />
				<label for="fullname">意见：<?php echo ($opinion["question"]); ?></label>
				<br /><br />
				<label for="fullname">回复：</label>
				<input type="text" name="answer" id="fullname" placeholder="" value="<?php echo ($opinion["answer"]); ?>">
				<br /><br />
			  </div>
			  <input type='hidden' name='opinion_id' value='<?php echo ($opinion["opinion_id"]); ?>'>
			  <input type="submit" data-theme="b" value="修改">
			</form>
		</div>
	</div> 
</body>
</html>