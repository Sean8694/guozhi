<?php
namespace Fruit\Controller;
use Think\Controller;
class ShareCouponController extends Controller {
	public function __construct(){
		parent::__construct();
		// weiId校验，保存登录状态
		$weiId		= I('session.openid');
		
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
			if(1)
			{
				$_SESSION['share_coupon_url'] = C('FRUIT_APP_URL').'/index.php/fruit/'.$_SERVER['PATH_INFO'];
				$base_url	= urlencode(C('FRUIT_APP_URL'));
				redirect('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx659ec57ec2da708e&redirect_uri='.$base_url.'%2Findex.php%2FWeichat%2Findex%2Fjumpto%2Faction%2Fsharecoupon&response_type=code&scope=snsapi_base&state=123#wechat_redirect');
			}
		}
		
		// 检查购物车
        $_SESSION['carnum'] = $_SESSION['carnum'] == '' ? 0 : $_SESSION['carnum'];
        if( count($_SESSION['car']) < 1 ){
            $_SESSION['carnum'] = 0;
        }
        // 重新计算购物车数量
        $real_car_num   = 0;
        foreach( $_SESSION['car'] as $kk => $vv ){
            $real_car_num += $vv['num'];
        }
        $_SESSION['carnum'] = $real_car_num;
		$this->assign('carnum',$_SESSION['carnum']);
	}

    public function index(){
		$couponid	= I('get.id');
		$m			= M('share_coupon');
		$coupon		= $m->where("`id`=$couponid")->select();
		$coupon[0]['left'] = $coupon[0]['num'] - $coupon[0]['used'];

        $this->assign('title','汁儿优惠券');
        $this->assign('coupon',$coupon[0]);
        $this->display();
    }

	public function get(){
		$couponid	= I('get.id');
		$coupontime	= I('get.t');
		$m			= M('share_coupon');
		$coupon		= $m->where("`id`=$couponid")->select();
		$coupon[0]['left'] = $coupon[0]['num'] - $coupon[0]['used'];

		if( $coupontime == $coupon[0]['ctime'] && $coupon[0]['left'] > 0 ){
			if( $_SESSION['user']['user_id'] ){
                // 是否抢过
				$code	= M('share_coupon_code');
                $hasget = $code->where("`user_id`='".$_SESSION['user']['user_id']."' AND `coupon_id`='".$couponid."'")
                    ->select();
                //print_r("`user_id`='.".$_SESSION['user']['user_id'].".' AND `coupon_id`='".$couponid."'");exit;
                if( $hasget ){
                    $echo = -2; // 已有
                }else{
                    $data['coupon_id']	= $coupon[0]['id'];
                    $data['user_id']	= $_SESSION['user']['user_id'];
                    $data['value']		= $coupon[0]['value'];
                    $data['status']		= 0;
                    $date				= date("Y-m-d H:i:s");
                    $data['get_time']	= $date;
                    $data['use_time']	= '';
                    $code->add($data);

                    $data2['id']	= $coupon[0]['id'];
                    $data2['used']	= $coupon[0]['used'] + 1;
                    $m->save($data2);
                    $echo = $data['value'];

                    $user		= $_SESSION['user'];
                    $userinfo   = M('user')->where(['user_id'=>$user['user_id']])->select();
                    $userinfo   = $userinfo[0];
                    $user_id = $user['user_id'];
                    $user_m  = M('user');
                    $data3['user_id'] = $user_id;
                    $data3['zhierbi'] = $userinfo['zhierbi'] + $data['value'];
                    $user_m->save($data3);
                }
			}else{
				$echo = -1; // 未登录
			}
		}else{
			$echo = 0;  // 抢光了
		}
		$this->assign('echo',$echo);
		$this->display();
	}
}
