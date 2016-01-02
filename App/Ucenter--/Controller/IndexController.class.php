<?php
namespace Fruit\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function __construct(){
		parent::__construct();
		// weiId校验，保存登录状态
		$weiId		= I('session.openid');
		//echo $weiId;exit;
		if( $weiId ){
			$sign		= I('get.sign');
			$token		= C('WEICHAT_TOKEN');
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
		}

		// 检查购物车
		$this->assign('carnum',count($_SESSION['car']));
	}

    public function index(){
        $this->assign('title','欢迎来到鲜果超人的世界！');
        $this->assign('carnum',count($_SESSION['car']));
        $this->display();
    }
    
    public function detail(){
        // print_r($_SESSION);exit;
    	$fruit_id	= I('get.id');
    	$fruit_m	= M('fruit');
    	$fruit		= $fruit_m->where("fruit_id={$fruit_id}")->select();
        $this->assign('fruit',$fruit);
        $this->assign('carnum',count($_SESSION['car']));
    	$this->display();	
    }

   // 加入购物车，返回购物车数量，如果在已经加了就不在添加 
   public function addtocar(){
        $fruit_id   = I('get.id');
        if( !in_array($fruit_id,$_SESSION['car']) && is_numeric($fruit_id) ){
            $_SESSION['car'][]    = $fruit_id;
        }    
        echo count($_SESSION['car']);
        exit;
   }

   // 从购物车删除
   public function delfromcar(){
		$fruit_id   = I('get.id');
		foreach( $_SESSION['car'] as $k=>$v ){
			if( $v =  $fruit_id ){
				unset($_SESSION['car'][$k]);
				break;
			}
		}
   }

    // 我的购物车
    public function mycar(){
        $fruit_m    = M('fruit');
        $fruit_ids  = implode(',',$_SESSION['car']);
        $fruit_ids  = trim($fruit_ids,',');
        if($fruit_ids){
            $fruit      = $fruit_m->where("fruit_id in({$fruit_ids})")->select();
        }
        $this->assign('fruit',$fruit);
        $this->assign('carnum',count($_SESSION['car']));    
        $this->display();
    }

    // 结算
    public function check(){
        // POST 过来的数据 [fruit_num_1] => 3
        $buy_post    = I('post.');
        // 返回的商品清单
        $buy_fruits  = array();
        // 购买的商品编号
        $fruit_ids   = '';
        foreach( $buy_post as $k=>$v ){
            $nk      = str_ireplace('fruit_num_','',$k);
            $fruit_ids  .= $nk.",";
            if( $v < 1 ){
                $v = 1;
            }
            $buy_fruits[$nk]    = $v;
        }
        $fruit_ids   = trim($fruit_ids,',');
        // 查询购买的水果列表
        $fruit_m     = M('fruit');
        if( $fruit_ids ){
            $fruits      = $fruit_m->where("fruit_id in({$fruit_ids})")->select();
            if( count($fruits) > 0 ){
                // 总价
                $total_price    = 0;
                foreach( $fruits as $k1=>$v1 ){
                    $fruits[$k1]['buynum']  = $buy_fruits[$v1['fruit_id']];
                    $total_price    += $fruits[$k1]['buynum'] * $fruits[$k1]['price'];
                }
                //print_r($fruits);exit;
            }
        }
		// 确认购买的套餐和数量保存到session
		$_SESSION['orders']	= $fruits;
		$_SESSION['total_price']	= $total_price;
		// 查询是否有默认收货地址
		$user_add_userid	= $_SESSION['user']['user_id'];
		if( $user_add_userid ){
			$user_add_m	= M('user_address');
			$user_add	= $user_add_m->where("`user_id`=$user_add_userid")->select();
			$user_add	= $user_add[0];
		}
		
		$this->assign('user_add',$user_add);
        $this->assign('fruits',$fruits);
        $this->assign('price',$total_price);
        $this->display();
    }

	// 提交订单
	public function suborder(){
		$post	= I('post.');
		$order	= $_SESSION['orders'];
		$weiId	= $_SESSION['weiId'];

		// 1 插入用户信息 user data
		$user_data['wei_id']	= $weiId;
		$user_data['name']		= $post['fname'];
		$user_data['mobile']	= $post['fmobile'];
		$user_data['ctime']		= time();
		$user_data['ltime']		= $user_data['ctime'];
		$user_m	= M('user');
		// 查询是否已经注册过
		$user_m_info	= $user_m->where("`wei_id`='{$weiId}'")->select();
		// 没有才插入新的
		if( $user_m_info[0]['wei_id'] != $weiId ){
			$user_m_info[0]['user_id'] = $user_m->add($user_data);
		}

		// 2 插入地址信息（前台选择地址，如果传入则保存新地址）
		$addid						= $post['addid'];
		$user_add_data['user_id']	= $user_m_info[0]['user_id'];
		$user_add_data['name']		= $post['fname'];
		$user_add_data['mobile']	= $post['fmobile'];
		$user_add_data['location']	= $post['fplace'];
		$user_add_data['location_detail']	= $post['fdetail'];
		$user_add_m	= M('user_address');
		// 如果没有传入收货地址ID，则保存到他的新收货地址中
		if( $addid < 1 ){
			$addid	= $user_add_m->add($user_add_data);
		}else{
			// 否则更新
			$user_add_data['add_id']	= $addid;
			$user_add_m->save($user_add_data);
		}
		// 查询这次下单的收货地址
		$user_add	= $user_add_m->where("`add_id`={$addid}")->select();

		// 3 订单信息
		$user_order_data['user_id']	= $user_m_info[0]['user_id'];
		$user_order_data['status']	= 1;
		$user_order_data['price']	= $_SESSION['total_price'];
		$user_order_data['ctime']	= time();
		$user_order_data['etime']	= '';
		$user_order_data['to_name']				= $user_add[0]['name'];
		$user_order_data['to_mobile']			= $user_add[0]['mobile'];
		$user_order_data['to_location']			= $user_add[0]['location'];
		$user_order_data['to_location_detail']	= $user_add[0]['location_detail'];
		$user_order_m	= M('order');
		$orderid		= $user_order_m->add($user_order_data);

		// 4 订单详情
		$order_m	= M('order_detail');
		foreach( $order as $k=>$v ){
			$order_data['order_id']		= $orderid;
			$order_data['fruit_id']		= $v['fruit_id'];
			$order_data['fruit_name']	= $v['name'];
			$order_data['buys']			= $v['buynum'];
			$order_data['fruit_version']= 'v444';
			$order_data['price']		= $v['price'];
			$order_m->add($order_data);
		}
		
		if( $orderid ){
			$result	= 'success';
			// 清空购物车
			$this->assign('carnum',0);
			unset($_SESSION['car']);
		}else{
			$result	= 'error';
		}
		$this->assign('result',$result);
		$this->display();
	}
}
