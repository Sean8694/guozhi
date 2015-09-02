<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function __construct(){
		parent::__construct();
		// weiId校验，保存登录状态
		$weiId		= I('session.openid');
		//echo $weiId;exit;
		if( $weiId && !$_SESSION['user']['user_id'] ){
			$sign		= I('get.sign');
			$token		= 'gao_1e_2015';
			$chacksign	= MD5("{$token}&{$weiId}");
			// 登录验证
			if( $chacksign != $sign ){
				//echo 'error';exit;
			}
			$_SESSION['weiId']	= $weiId;
			// 是否已注册
			$user_m	= M('user');
			$user	= $user_m->where("`wei_id`='{$weiId}'")->select();
			// 第一次需要注册
			if( count($user) == 0 ){
				$user_data['wei_id']	= $weiId;
				$user_data['ctime']		= time();
				$user_data['ltime']		= $user_data['ctime'];
				$user_data['name']		= $_SESSION['nickname'];
				$user_data['face']		= $_SESSION['headimgurl'];
				$user_m->add($user_data);
				$user	= $user_m->where("`wei_id`='{$weiId}'")->select();
				// 保存一个收货地址
				$add_data['user_id']	= $user[0]['user_id'];
				$add_data['name']		= $user_data['name'];
				$add_m					= M('user_address');
				$add_m->add($add_data);
			}else{
			// 第二次需要更新登录时间
				$user_data['ltime']		= time();
				$user_data['user_id']	= $user[0]['user_id'];
				$user_m->save($user_data);
			}

			$_SESSION['user']	= $user[0];
		}elseif( !$_SESSION['user']['user_id'] && $_SESSION['hasJumped']!=1 ){
			// 标记，这个跳转只执行一次
			$_SESSION['hasJumped']	= 1;
			// 跳转到获取微信信息页面
			$base_url	= urlencode(C('FRUIT_APP_URL'));
			redirect('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx659ec57ec2da708e&redirect_uri='.$base_url.'%2Findex.php%2FWeichat%2Findex%2Fjumpto%2Faction%2Flocation&response_type=code&scope=snsapi_base&state=123#wechat_redirect');
		}

		// 检查购物车
        $_SESSION['carnum'] = $_SESSION['carnum'] == '' ? 0 : $_SESSION['carnum'];
		$this->assign('carnum',$_SESSION['carnum']);
	}
	
	public function index(){
		// 个人信息
		$user		= $_SESSION['user'];
        $userinfo   = M('user')->where(['user_id'=>$user['user_id']])->select();
        $userinfo   = $userinfo[0];

		// 订单数量
		$order_m	= M('order');
		$order_num	= $order_m->where("`user_id`='".$user['user_id']."'")->field("count(1) order_num")->select();
		// 意见数量
		$opinion_m		= M('opinion');
		$opinion_num	= $opinion_m->where("`user_id`='".$user['user_id']."'")->field("count(1) opinion_num")->select();
		
		$this->assign('user',$user);
        $this->assign('userinfo',$userinfo);
		$this->assign('order_num',$order_num[0]['order_num']);
		$this->assign('opinion_num',$opinion_num[0]['opinion_num']);
		$this->assign('carnum',$_SESSION['carnum']);
        $this->display();
    }

	// 我的订单
	public function orders(){
		// 个人信息
		$user			= $_SESSION['user'];
		// 查询全部订单（每次加载10个）
		$order_m		= M('order');
		$order_list		= $order_m->where("`user_id`='".$user['user_id']."'")->order("order_id DESC")->limit("10")->select();
		$order_status	= C('ORDER_STATUS');
		$order_location	= C('ADD_LOCATION');
		// 查询每个订单的详情
		$order_detail_m	= M('order_detail');
		// 使用优惠券情况
		$order_coupon_m	= M('user_coupon');
		// 查询所有优惠券名称
		$order_coupon_name_m = M('fruit_type');
		$order_coupon_name	 = $order_coupon_name_m->select();
		foreach( $order_list as $k=>$v ){
			// 状态替换
			$order_list[$k]['statusold']= $order_list[$k]['status'];
			$order_list[$k]['status']	= $order_status[$v['status']];
			// 收货区域替换
			$order_list[$k]['to_location']	= $order_location[$v['to_location']];
			// 时间戳转换
			$order_list[$k]['ctime']	= date("m/d H:i",$v['ctime']);
			// 订单明细查询
			$order_list[$k]['detail']	= $order_detail_m->where("`order_id`='".$v['order_id']."'")->select();
			$detail_str	= '';
			foreach( $order_list[$k]['detail'] as $k2=>$v2 ){
				if( $v2['addname'] ){
					$detail_str	.= "<span>".$v2['fruit_name'].' ['.$v2['addname'].']'."x".$v2['buys']."</span>";
				}else{
					$detail_str	.= "<span>".$v2['fruit_name']."x".$v2['buys']."</span>";//.'（￥'.$v2['price'].'*'.$v2['buys'].'）'."</span>";
				}
			} 
			$order_list[$k]['detail']	= trim($detail_str);
			// 优惠券的使用
			$coupon_str					= '';
			$coupon_arr					= $order_coupon_m->query("
SELECT c.coupon_id,t.type_id,t.coupon_name, count( c.coupon_id ) coupon_count
FROM `user_coupon` c
LEFT JOIN fruit_type t ON c.type_id = t.type_id
WHERE `order_id` ='".$v['order_id']."'
GROUP BY c.type_id
			");
			//print_r($coupon_arr);exit;
			foreach( $coupon_arr as $k4 => $v4 ){
				foreach( $order_coupon_name as $k5 => $v5 ){
					if( $v5['type_id'] == $v4['type_id'] ){
						$coupon_arr[$k4]['coupon_name']	= $v5['coupon_name'];
						$coupon_str		.= ','.$v5['coupon_name'].' '.$v4['coupon_count'].' 张';
					}else{
						continue;
					}
				}
			}
			$coupon_str	= trim($coupon_str,',');
			$order_list[$k]['coupon']	= $coupon_str;
		}
		$this->assign('order_status',$order_status);
		$this->assign('order_list',$order_list);
		$this->display();
	}

	// 意见反馈-列表
	public function opinion(){
		$user			= $_SESSION['user'];
		// 查询意见
		$opinion_m		= M('opinion');
		$opinion_list	= $opinion_m->where("`user_id`='".$user['user_id']."'")->order("opinion_id DESC")->limit("5")->select();
		$this->assign('opinion',$opinion_list);
		$this->display();
	}

	// 意见反馈-添加
	public function addopinion(){
		$user			= $_SESSION['user'];
		$data			= I('post.');
		$data['question']	= $data['opinion'] ? $data['opinion'] : '';
		$data['user_id']	= $user['user_id'];
		$data['qtime']		= time();
		$opinion_m		= M('opinion');
		$opinion_r		= $opinion_m->add($data);
		$this->display('opinion_ok');
	}

	// 添加评论
	public function comment(){
		$order_id	= I('get.id');

		// 订单信息
		$order_m		= M('order');
		$order_list		= $order_m->where("`order_id`='".$order_id."'")->select();
		$order_status	= C('ORDER_STATUS');
		$order_location	= C('ADD_LOCATION');
		// 查询每个订单的详情
		$order_detail_m	= M('order_detail');
		// 使用优惠券情况
		$order_coupon_m	= M('user_coupon');
		// 查询所有优惠券名称
		$order_coupon_name_m = M('fruit_type');
		$order_coupon_name	 = $order_coupon_name_m->select();
		foreach( $order_list as $k=>$v ){
			// 状态替换
			$order_list[$k]['status']	= $order_status[$v['status']];
			// 收货区域替换
			$order_list[$k]['to_location']	= $order_location[$v['to_location']];
			// 时间戳转换
			$order_list[$k]['ctime']	= date("Y/m/d H:i",$v['ctime']);
			// 订单明细查询
			$order_list[$k]['detail']	= $order_detail_m->where("`order_id`='".$v['order_id']."'")->select();
			$fruit_list					= $order_list[$k]['detail'];
			$detail_str	= '';
			foreach( $order_list[$k]['detail'] as $k2=>$v2 ){
				$detail_str	.= $v2['fruit_name'].'（￥'.$v2['price'].'*'.$v2['buys'].'）<br />';
			} 
			$order_list[$k]['detail']	= trim($detail_str,'<br />');
			// 优惠券的使用
			$coupon_str					= '';
			$coupon_arr					= $order_coupon_m->query("
SELECT c.coupon_id,t.type_id,t.coupon_name, count( c.coupon_id ) coupon_count
FROM `user_coupon` c
LEFT JOIN fruit_type t ON c.type_id = t.type_id
WHERE `order_id` ='".$v['order_id']."'
GROUP BY c.type_id
			");
			//print_r($coupon_arr);exit;
			foreach( $coupon_arr as $k4 => $v4 ){
				foreach( $order_coupon_name as $k5 => $v5 ){
					if( $v5['type_id'] == $v4['type_id'] ){
						$coupon_arr[$k4]['coupon_name']	= $v5['coupon_name'];
						$coupon_str		.= ','.$v5['coupon_name'].' '.$v4['coupon_count'].' 张';
					}else{
						continue;
					}
				}
			}
			$coupon_str	= trim($coupon_str,',');
			$order_list[$k]['coupon']	= $coupon_str;
			//print_r($coupon_arr);exit;
		}

		// 评论信息
		$comment_m	= M('order_detail');
		$comment	= $comment_m->where("`order_id`='".$order_list[0]['order_id']."'")->select();

		$this->assign('fruit_list',$fruit_list);
		$this->assign('order_status',$order_status);
		$this->assign('order_list',$order_list);
		$this->assign('comment',$comment[0]);
		$this->display();
	}

	// 添加评论-提交
	public function addcomment(){
		$user			= $_SESSION['user'];
		$postdata		= I('post.');
		$order_detail_m	= M('order_detail'); 
		// 一次评论多个水果的，需要处理  comment_88=>评论内容  88为编号
		foreach( $postdata as $k=>$v ){
			$data						= array();
			$order_detail_id			= str_ireplace('comment_','',$k);
			if( is_numeric($order_detail_id) ){
				$data['order_detail_id']	= $order_detail_id;
				$data['commend']			= $v;
				$data['commend_status']			= 1;
				$order_detail_m->save($data);
			}
		}
		// 更新订单为已经评论状态
		$data2['order_id']		= $postdata['orderid'];
		$data2['iscommend']	= 1;
		$order_m				= M('order');
		$order_m->save($data2);

		header("Location:".C('FRUIT_APP_URL')."/index.php/home/index/comment/id/".$data2['order_id']);
	}

	// 我的钱包
	public function wallet(){
		$user_id	= $_SESSION['user']['user_id'];
		// 查询优惠券名称
		$type_m		= M('fruit_type');
		$types		= $type_m->select();

		// 查询当前用户的优惠券
		$coupon_m	= M('user_coupon');
		$coupons	= $coupon_m->query("
			SELECT t.type_id, t.coupon_name, COUNT( c.coupon_id ) type_count
			FROM `fruit_type` t
			LEFT JOIN `user_coupon` c ON c.type_id = t.type_id
			AND c.user_id ='".$user_id."'
			AND c.is_used !=1
			WHERE 1
			GROUP BY t.type_id
			ORDER BY `order` DESC
			LIMIT 0 , 10
		");
		$this->assign("coupons",$coupons);
		$this->display();
	}

	// 我的钱包-优惠券详情
	public function walletCoupon(){
		$type_id	= I("get.typeid");
		// 优惠券类型
		// 查询优惠券名称
		$type_m		= M('fruit_type');
		$types		= $type_m->where("`type_id`=$type_id")->select();
		// 优惠券详情列表
		$coupon_m	= M('user_coupon');
		$coupons	= $coupon_m->where("`type_id`=$type_id")->order("`is_used` ASC, `valid_time` DESC")->limit(40)->select();
		$this->assign("coupons",$coupons);
		$this->assign("types",$types[0]);
		$this->display();
	}

	// 我的钱包-获得更多优惠券
	public function walletGetmore(){
		$type_id	= I("get.typeid");
		// 优惠券类型
		// 查询优惠券名称
		$type_m		= M('fruit_type');
		$types		= $type_m->where("`type_id`=$type_id")->select();
		$this->assign("types",$types[0]);
		$this->display();
	}

	// 我的钱包-购买优惠券
	public function couponBuy(){
        echo 'zhier...';exit;
		$type_id	= I("get.typeid");
		$time		= time();
		$is_used	= 0;
		$pay_order	= 20150531;
		$user_id	= $_SESSION['user']['user_id'];
		//$values		= '';
		$data		= array();
		// 创建5个购物券
		for( $i=1 ;$i<=5;$i++ ){
			//$values		.= "(NULL,'$user_id','$type_id','$time','$pay_order'),";
			$data[]	= array('user_id'=>$user_id,'type_id'=>$type_id,'having_time'=>$time,'pay_order'=>$pay_order);
		}
		//$values		= trim($values,',');
		//$sql		= "INSERT INTO `user_coupon` (`coupon_id`,`user_id`,`type_id`,`having_time`,`pay_order`) VALUES $values";
		// 插入
		$coupon_m	= M('user_coupon');
		//print_r($data);exit;
		if($coupon_m->addAll($data)){
			$this->success('获取成功', C('HOME_COUPON'));
		}else{
			$this->error('获取失败', C('HOME_COUPON'));
		}
	}

	public function sharecoupon(){
		//echo $_SESSION['user']['user_id'];exit;
		if( $_SESSION['user']['user_id'] ){
			$userid	= $_SESSION['user']['user_id'];
			$m			= M('share_coupon_code');
			$coupons		= $m->where("`user_id`=$userid AND `status`=0")->select();
			$this->assign("coupons",$coupons);
			$this->display();
		}
	}

	// 个人资料
	public function myinfo(){
		$user_id		= $_SESSION['user']['user_id'];

		// 更新信息
		$data			= I("post.");
		if( $data ){
			$newdata['user_id']			= $user_id;
			$newdata['name']			= $data['fname'];
			$newdata['mobile']			= $data['fmobile'];
			$newdata['location']		= $data['fplace'];
			$newdata['location_detail']	= $data['fdetail'];
			$newdata['add_id']			= $data['addid'];

			$address_m	= M('user_address');
			// 如果传递了 地址 id 说明是更新
			if( $newdata['add_id'] ){
				$address_m->save($newdata);
			}else{
				// 否则是新建
				unset($newdata['add_id']);
				$address_m->add($newdata);
			}
			$this->redirect('index');
			$this->assign('user_add',$newdata);
		}else{
			// 查询地址
			$user_add_m		= M('user_address');
			$user_add		= $user_add_m->where("`user_id`='{$user_id}'")->select();
			$this->assign('user_add',$user_add[0]);
		}

		// 区域选项
		$location_m	= M('location_office');
		$location	= $location_m->select();
		$this->assign('location',$location);
		$this->assign('now_location',$_SESSION['location']);

		$this->display();
	}

    public function sharecouponshare(){
        $order_id   = I('get.id');
        $coupon_m   = M('share_coupon');
        $coupon     = $coupon_m->where("`order_id`='".$order_id."'")->select();
        if( $coupon ){
            $id = $coupon[0]['id'];
        }else{
            $date   = date("Y-m-d H:i:s");
            $share_coupon = M('share_coupon');
            $data['title']= $_SESSION['user']['name'].' 发汁儿的红包啦，快来抢！';
            $data['ctime']= $date;
            $data['utime']= $date;
            $data['order_id']   =$order_id;
            $data['num']        =3;
            $data['value']      =2;
            if( $id = $share_coupon->add($data) ){
                $id;
            }
        }
        header("Location:".C('FRUIT_APP_URL')."/index.php/fruit/ShareCoupon/index/id/$id");
    }
}