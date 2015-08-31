<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_L_DELIM'=>'<{', //修改左定界符
	'TMPL_R_DELIM'=>'}>', //修改右定界符
	'SHOW_PAGE_TRACE'=>false,//开启页面Trace
	'FRUIT_APP_URL'	=> 'http://izhier.com/', // 应用目录
    'FRUIT_APP_URL_DE'	=> 'izhier.com', // 应用目录
	// 微信参数
	'WEICHAT_APPID'	=> 'wx659ec57ec2da708e',
	'WEICHAT_SECRET'=> '32eb64709524ea9eb8d0c9dd8b4a63d0',
	// 数据库
	'DB_TYPE'=>'mysql', //设置数据库类型
	'DB_HOST'=>'localhost',//设置主机
	'DB_NAME'=>'zhier',//设置数据库名
	'DB_USER'=>'root', //设置用户名
	'DB_PWD'=>'zhi*er@o1W', //设置密码
	'DB_PORT'=>'3306', //设置端口号
	'DB_PREFIX'=>'', //设置表前缀
	// 订单状态对应关系
	'ORDER_STATUS'	=> array('1'=>'<span style="color:red">已下单</span>','2'=>'<span style="color:blue">制作中','3'=>'<span style="color:green">配送中</span>',4=>'已送达',5=>'已退单'),
	// 加密参数
	'ADMIN_SAIT'	=> '8Ip6',
	// 配送区域
	'ADD_LOCATION'	=> array('010_hd_rkzxzx'=>'国贸001','010_hd_wkd'=>'国贸002','010_hd_zgc'=>'国贸003','010_hd_wdk'=>'国贸004'),
	// 配送时间
	'SEND_TIME'		=> array('14:00'=>'14:00-15:00','16:00'=>'16:00-17:00'),
	// 管理后台-菜单列表
	'ADMIN_LIST'	=> array('产品'=>'Product','用户'=>'User','订单'=>'Index','评价'=>'Recommend','反馈'=>'Opinion','分享券'=>'ShareCoupon'),
	// 管理后台-图片上传目录
	'ADMIN_UPLOAD'	=> '/var/www/guozhi/Public/upload',
	// 管理后台-展示图片位置
	'ADMIN_IMG'		=> '/var/www/guozhi/Public/upload/product/',
	// 管理后台-登录
	'ADMIN_LOGIN'	=> 'http://izhier.com/index.php/Admin/Admin/',
	// 管理后台-地址
	'ADMIN_INDEX'	=> 'http://izhier.com/index.php/Admin/Product/',
	// 管理后台-意见地址
	'ADMIN_OPINION'	=> 'http://izhier.com/index.php/Admin/Opinion/',
	// 管理后台-意见地址
	'ADMIN_RECOMMEND'	=> 'http://izhier.com/index.php/Admin/Recommend/',
	// 管理后台-意见状态
	'OPINION_STATUS'=> array(0=>array('status'=>0,'statusname'=>'未回复'),1=>array('status'=>1,'statusname'=>'已回复')),
	// 管理后台-订单评论
	'ORDER_COMMEND_STATUS'=> array(1=>array('status'=>1,'statusname'=>'未回'),2=>array('status'=>2,'statusname'=>'隐藏'),3=>array('status'=>3,'statusname'=>'已回'),0=>array('status'=>0,'statusname'=>'未评'),4=>array('status'=>4,'statusname'=>'不回')),
	// 个人中心-我的钱包
	'HOME_COUPON'=> 'http://izhier.com/index.php/Home/Index/wallet',
	// 整体折扣
	'GLOBAL_DISCOUNT' => ['DISCOUNT'=>0.8,'REASION'=>'开业庆典，全场8折优惠'],
);
