<?php
namespace Fruit\Controller;
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
			if(strpos($_SERVER['HTTP_USER_AGENT'],"MicroMessenger "))
			{
				$base_url	= urlencode(C('FRUIT_APP_URL'));
				redirect('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx659ec57ec2da708e&redirect_uri='.$base_url.'%2Findex.php%2FWeichat%2Findex%2Fjumpto%2Faction%2Flocation&response_type=code&scope=snsapi_base&state=123#wechat_redirect');
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

	// 第一个页面，选择楼宇 /zhier/index.php/fruit/index/location
	public function location(){
		// 处理Ajax请求
		$keyword	= trim(I("get.keyword"));
		$keyword	= htmlspecialchars(addslashes(trim($keyword)));
		if( $keyword ){
			$location_m	= M('location_office');
			$location_r	= $location_m->where("`search_word` LIKE '%{$keyword}%'")->limit(3)->select();
			$arr	= array("resum"=>COUNT($location_r),"relist"=>$location_r);
			//print_r($location_r);
			//print_r($arr);
			//exit;
			$str	= json_encode($arr);
			echo $str;
			exit;
		}else{
			$this->assign('baseurl',C('FRUIT_APP_URL'));
			$this->display();
		}
	}

    public function index(){
		// 将地域信息保存到SESSION
		$location	= intval( I('get.office_id') );
		if( $location > 0 ){
			$_SESSION['location'] = $location;
		}

		// 筛选
		$type		= intval(I("get.type"));
		if( $type > 0 ){
			$where	= " `type_id`={$type} ";
			$order  = "`order` DESC";
			// 选中样式
			$this->assign('selected',$type);
		}else{
			$where	= " `recommend`=1 ";
			$order  = "`price` DESC";
			// 选中样式
			$this->assign('selected','recommend');
		}
		// 分类列表
		$type_m		= M('fruit_type');
		$type		= $type_m->order("`order` DESC")->select();
		$this->assign('type',$type);

		$fruit_m	= M('fruit');
		$fruit		= $fruit_m->where("`order`!=0 AND {$where} ")->order($order)->select();
		$this->assign('fruit',$fruit);
        $this->assign('title','欢迎来到鲜果超人的世界！');
        $this->assign('carnum',$_SESSION['carnum']);
        $this->display();
    }
    
    public function detail(){
        // print_r($_SESSION);exit;
    	$fruit_id	= I('get.id');
    	$fruit_m	= M('fruit');
    	$fruit		= $fruit_m->where("fruit_id={$fruit_id}")->select();

		// 查询附加条件
		$fruitadd_m	= M('fruit_addinfo');
		$fruitadd	= $fruitadd_m->order("display_order desc")->where("`fruit_id`='$fruit_id' AND `display_order`!=0")->select();
		$this->assign('fruitadd',$fruitadd);
		$this->assign('fruitaddcount',count($fruitadd));

		// 购买数，评论数
		$detail		= M('order_detail');
		//$buys		= $detail->field("count(1) buys")->where("fruit_id={$fruit_id}")->select();
		//$buys		= $buys[0]['buys']+$fruit[0]['buys'];
		$buys		= $fruit[0]['buys'];
		$comments	= $detail->field("count(1) comments")->where("fruit_id={$fruit_id} and commend!='0'")->select();
		$comments	= $comments[0]['comments'];

		$gloabl_discount	= C('GLOBAL_DISCOUNT');
		$fruit[0]['discount_price'] = intval($gloabl_discount['DISCOUNT']*$fruit[0]['price']);

		$shi	= date("H");
		if( $shi > 19 || $shi < 10 ){
			$close = 1;
		}else{
			$close = 0;
		}
		$this->assign('close',$close);

        $this->assign('buys',$buys);
		$this->assign('comments',$comments);
		$this->assign('fruit',$fruit);
        $this->assign('carnum',$_SESSION['carnum']);
		$this->assign('gloabl_discount',$gloabl_discount);
    	$this->display();	
    }

   // 加入购物车，返回购物车数量，如果在已经加了就不在添加 
   public function addtocar(){
        $fruit_id		= I('get.id');
		$fruit_addinfo	= trim(I('get.addinfo'),',');
		//echo $fruit_addinfo;exit;
        if( is_numeric($fruit_id) ){
			// 尝试删除之前已经加入购物车的
			foreach( $_SESSION['car'] as $k=>$v ){
				if( $v['fruit_id'] == $fruit_id && $v['fruit_addinfo'] == $fruit_addinfo ){
					$_SESSION['car'][$k]['num'] = $_SESSION['car'][$k]['num'] + 1;
                    $has    = 1;
				}
			}

            if($has != 1){
                // 添加到购物车
                $fruit_arr					= array();
                $fruit_arr['car_id']		= time();
                $fruit_arr['fruit_id']		= $fruit_id;
                $fruit_arr['fruit_addinfo']	= trim($fruit_addinfo,",");
                $fruit_arr['num'] = 1;

                // 查询附加信息中文名
                // $fruit_addinfo;exit;
                if( $fruit_addinfo ){
                    $addinfo_m					= M('fruit_addinfo');
                    $addinfo_a					= $addinfo_m->where("`id` in(".$fruit_arr['fruit_addinfo'].")")->select();
                    $addinfo_s					= '';
                    foreach( $addinfo_a as $k2 => $v2 ){
                        $addinfo_s	.= ','.$v2['name'];
                    }
                    $fruit_arr['fruit_addname']	= trim($addinfo_s,',');
                    
                }

                $_SESSION['car'][]			= $fruit_arr;
            }
        }
        $_SESSION['carnum'] = $_SESSION['carnum']+1;
		// 如果传递了 buyit 参数，表示用户点击的是直接购买，则跳转到购物车页面
		$buyid	= I('get.buyit');
		if( $buyid == 1 ){
			echo 1024;  // 返回1024，给JS，表示跳转到购物车。。。
			exit;
		}else{
			echo $_SESSION['carnum'];
			exit;
		}
   }

   // 从购物车删除
   public function delfromcar(){
		$car_id   = I('get.id');
		//print_r($_SESSION['car']);exit;
		foreach( $_SESSION['car'] as $k=>$v ){
			if( $v['car_id'] ==  $car_id ){
                $_SESSION['carnum'] = $_SESSION['carnum'] - $_SESSION['car'][$k]['num'] ;
                unset($_SESSION['car'][$k]);
				break;
			}
		}
        
        // 重新计算购物车数量
        $real_car_num   = 0;
        foreach( $_SESSION['car'] as $kk => $vv ){
            $real_car_num += $vv['num'];
        }
        $_SESSION['carnum'] = $real_car_num;
        echo $real_car_num;
   }

    // 我的购物车
    public function mycar(){
        $fruit_m    = M('fruit');
		
		// 已经加入购物车的所有 fruit_id
		$fruit_ids	= '';
		foreach( $_SESSION['car'] as $k => $v ){
			$fruit_ids	.= ",".$v['fruit_id'];
		}
		$fruit_ids  = trim($fruit_ids,',');
        
		if($fruit_ids){
            $fruit      = $fruit_m->where("fruit_id in({$fruit_ids})")->order("`price` DESC")->select();
        }

		// 根据购物车重新构建最终的fruit
		$newfruit	= array();
		foreach( $_SESSION['car'] as $k6 => $v6 ){
			foreach( $fruit as $k5 => $v5 ){
				if( $v5['fruit_id'] == $v6['fruit_id'] ){
					$newfruit[]	= $fruit[$k5];
					break;
				}
			}
		}
		$fruit	= $newfruit;
		//print_r($newfruit);exit;

		// $fruit ,加入附加条件
		//print_r($_SESSION['car']);exit;
		$addinfo_m	= M('fruit_addinfo');
		$newfruit	= array();	
		//print_r($_SESSION['car']);exit;
		$gloabl_discount	= C('GLOBAL_DISCOUNT');
		foreach( $_SESSION['car'] as $k3 => $v3 ){
			//echo $v3['fruit_addinfo'];exit;
			if($v3['fruit_addname']){	
				foreach( $fruit as $k2 => $v2 ){
					if( $v2['fruit_id'] == $v3['fruit_id'] ){
						$fruit[$k2]['addinfo']	= $v3['fruit_addname'];
						$fruit[$k2]['car_id']	= $v3['car_id'];
                        $fruit[$k2]['num']	= $v3['num'];
						//$fruit[$k2]['price']	= intval($gloabl_discount['DISCOUNT']*$v2['price']);
						$newfruit[]	= $fruit[$k2];
						break;
					}else{
						//break;
					}
				}
			}else{				
				foreach( $fruit as $k2 => $v2 ){
					
					if( $v2['fruit_id'] == $v3['fruit_id'] ){
						$fruit[$k2]['addinfo']	= '';
						$fruit[$k2]['car_id']	= $v3['car_id'];
                        $fruit[$k2]['num']	= $v3['num'];
						//$fruit[$k2]['price']	= intval($gloabl_discount['DISCOUNT']*$v2['price']);
						//print_r($fruit[$k2]);exit;
						$newfruit[]	= $fruit[$k2];
						break;
					}else{
						//break;
					}
				}
			}
		}
		foreach( $newfruit as $k=> $v ){
			$newfruit[$k]['price']	= intval($gloabl_discount['DISCOUNT']*$v['price']);
		}
		//print_r($newfruit);exit;
		$fruit	= $newfruit;

        $this->assign('fruit',$fruit);
        $this->assign('carnum',$_SESSION['carnum']);    
        $this->assign('baseurl',C('FRUIT_APP_URL'));
        $this->display();
    }

    // 结算
    public function check(){
		$login_user_id	=$_SESSION['user']['user_id'];
        // POST 过来的数据 [fruit_num_1] => 3
        $buy_post    = I('post.');
		if(count($buy_post)<1){
			header("Location:".C('FRUIT_APP_URL')."/index.php/fruit/index/mycar");
		}
        // 返回的商品清单
        $buy_fruits  = array();
        // 购买的商品编号
        $fruit_ids   = '';
		
        foreach( $buy_post as $k=>$v ){
            $nk      = str_ireplace('fruit_num_','',$k);
			foreach( $_SESSION['car'] as $k2=>$v2 ){
				if( $v2['car_id'] == $nk ){
					$fruit_ids  .= $v2['fruit_id'].",";
				}
			}
            
            if( $v < 1 ){
                $v = 1;
            }
            $buy_fruits[$nk]    = $v;
        }
		//print_r($buy_fruits);exit;
        $fruit_ids   = trim($fruit_ids,',');
		//print_r($fruit_ids);exit;
        // 查询购买的水果列表
        $fruit_m     = M('fruit');
        if( $fruit_ids ){
			// 按价钱排序，是为了确保优惠券优先匹配到价钱贵的商品
            $fruits      = $fruit_m->where("fruit_id in({$fruit_ids})")->order("`price` DESC")->select();

            if( count($fruits) > 0 ){
				// 查询优惠券信息，默认消耗快到期的优惠券
				$coupon_m	= M('user_coupon');
				// 定义优惠券已经在本次购物中使用情况（两种 咖啡，第一种用过了优惠券 1024，第二种就不能再用 1024）
				$coupon_used= '0';
				$_SESSION['coupon_used']	= '';

                // 总价
                $total_price    = 0;
				$newFruit		= array();
				foreach( $_SESSION['car'] as $k3 => $v3 ){
					if( $v3['fruit_addinfo'] > 0 ){
						foreach( $fruits as $k1=>$v1 ){
							if( $v1['fruit_id'] == $v3['fruit_id'] ){
								//print_r($v3);exit;
								$fruits[$k1]['fruit_addinfo']  = $v3['fruit_addinfo'];
								$fruits[$k1]['fruit_addname']  = $v3['fruit_addname'];
								// 查询购买数量
								foreach( $buy_fruits as $k4 => $v4 ){
									if( $k4 == $v3['car_id'] ){
										$fruits[$k1]['buynum']		   = $v4;
										break;
									}
								}
								$newFruit[]	= $fruits[$k1];
								break;
							}
						}
					}else{
						foreach( $fruits as $k1=>$v1 ){
							if( $v1['fruit_id'] == $v3['fruit_id'] ){
								// 查询购买数量
								foreach( $buy_fruits as $k4 => $v4 ){
									$fruits[$k1]['fruit_addinfo']  = '';
									$fruits[$k1]['fruit_addname']  = '';
									if( $k4 == $v3['car_id'] ){
										$fruits[$k1]['buynum']		   = $v4;
										break;
									}
								}
								$newFruit[]	= $fruits[$k1];
								break;
							}
						}
					}
				}
				$fruits	= $newFruit;
				
                foreach( $fruits as $k1=>$v1 ){
					// 附加条件
					/*
					foreach( $_SESSION['car'] as $k3 => $v3 ){
						if( $v1['fruit_id'] == $v3['fruit_id'] ){
							$fruits[$k1]['fruit_addinfo']  = $v3['fruit_addinfo'];
							$fruits[$k1]['fruit_addname']  = $v3['fruit_addname'];
						}
					}*/
                    //$fruits[$k1]['buynum']  = $buy_fruits[$v1['fruit_id']];

					// 处理优惠券的使用，查询优惠券，如果有，则不增加总价
					$coupon_tem	= $coupon_m->where("`type_id`='".$v1['type_id']."' AND `user_id`='".$login_user_id."' AND is_used!=1 AND `coupon_id` NOT IN(".$coupon_used.")")->limit($fruits[$k1]['buynum'])->select();
					// 这个产品的优惠券数量
					$fruits[$k1]['coupon_num']	= count($coupon_tem);
					// 这个产品消耗优惠券获得优惠价钱
					$fruits[$k1]['coupon_price']	= count($coupon_tem) * $fruits[$k1]['price'];
					// 记录这个优惠券在这购物中已经使用过，下次foreach不能在使用这个优惠券
					foreach( $coupon_tem as $k4 => $v4 ){
						$coupon_used	.= ','.$v4['coupon_id'];
					}
					$coupon_used	= trim($coupon_used,',');
					//echo $coupon_used;exit;

					//print_r($coupon_tem);exit;
					// 查询优惠券，如果有，则不增加总价  

					$gloabl_discount	= C('GLOBAL_DISCOUNT');
					$fruits[$k1]['price']	= intval( $gloabl_discount['DISCOUNT'] * $fruits[$k1]['price'] );
                    $total_price    += ($fruits[$k1]['buynum']-count($coupon_tem)) * $fruits[$k1]['price'];
                }
				
				// 已使用的优惠券，保存到session里面
				$_SESSION['coupon_used']	= $coupon_used;
                //print_r($coupon_used);exit;
            }
        }
		//print_r($fruits);exit;
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

		// 区域选项
		$location_m	= M('location_office');
		$location	= $location_m->select();
		$this->assign('location',$location);
		if( !$_SESSION['location'] ){
			$_SESSION['location'] = $user_add['location'];
		}
		$this->assign('now_location',$_SESSION['location']);

		// 时间选择
		$sendtime	= C('SEND_TIME');

		// 时间选择
		$nowtime	= time();
		$sendtime2	= $sendtime;
		foreach( $sendtime as $k=>$v ){
			$vtime	= strtotime($k);
			// 如果现在时间 - v 时间 > 15分钟 ，则不能选择这个时间
			$dtime	= ($nowtime-$vtime)/60;
			//echo $dtime.'|||'..'<hr />';
			if( $dtime >= -30 ){
				unset($sendtime[$k]);
			}
		}

        $price = $total_price;
		$price = $price > 0 ? $price : 0;

        // 个人信息
		$user		= $_SESSION['user'];
        $userinfo   = M('user')->where(['user_id'=>$user['user_id']])->select();
        $userinfo   = $userinfo[0];
        $zhierbi    = $userinfo['zhierbi'] ? $userinfo['zhierbi'] : 4;
        $zhierbi = $price >= $zhierbi ? $zhierbi : $price;
		
		$this->assign('location',$location);
		$this->assign('sendtime',$sendtime);
		$this->assign('sendtime2',$sendtime2);	// 明日配送
		$this->assign('user_add',$user_add);
        $this->assign('fruits',$fruits);
        $this->assign('zhierbi',$zhierbi);
        $this->assign('price',$price);
        $this->display();
    }

	// 提交订单
	public function suborder(){
		$post	= I('post.');
        if( count($post) < 1 ){
            header("Location:".C('FRUIT_APP_URL')."/index.php/fruit/index");
            exit;
        }
		$order	= $_SESSION['orders'];
		$weiId	= $_SESSION['weiId'];
		$_SESSION['carnum'] = 0;

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
		// 如果之前姓名为空，则更新数据
		if( $user_m_info[0]['name'] == '' ){
			$user_data2['user_id']	= $_SESSION['user']['user_id'];
			$user_data2['name']		= $post['fname'];
			$user_data2['mobile']	= $post['fmobile'];
			$user_m->save($user_data2);
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
        // 使用汁儿币
        $use_zhierbi = $post['use_zhierbi'];
        if( $use_zhierbi ){
            $user		= $_SESSION['user'];
            $userinfo   = M('user')->where(['user_id'=>$user['user_id']])->select();
            $userinfo   = $userinfo[0];
            $zhierbi    = $userinfo['zhierbi'] ? $userinfo['zhierbi'] : 4;
            $zhierbi = $_SESSION['total_price'] >= $zhierbi ? $zhierbi : $_SESSION['total_price'];  
            $_SESSION['total_price'] = $_SESSION['total_price'] - $zhierbi;

            $user_m_zhibi  = M('user');
            $data3_zhibi['user_id'] = $user['user_id'];
            $data3_zhibi['zhierbi'] = $userinfo['zhierbi'] - $zhierbi;
            $user_m_zhibi->save($data3_zhibi);
        }

		$user_add	= $user_add_m->where("`add_id`={$addid}")->select();

		$user_order_data['sendtime']	= $post['fsendtime'] ? $post['fsendtime'] : 0000000000;
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
		$fruit_m	= M('fruit');
		foreach( $order as $k=>$v ){
			$order_data['order_id']		= $orderid;
			$order_data['fruit_id']		= $v['fruit_id'];
			$order_data['fruit_name']	= $v['name'];
			$order_data['buys']			= $v['buynum'];
			$order_data['fruit_version']= 'v444';
			$order_data['price']		= $v['price'];
			$order_data['addinfo']		= $v['fruit_addinfo'];
			$order_data['addname']		= $v['fruit_addname'];
			//print_r($order);exit;
			$order_m->add($order_data);
			// 所购产品的购买数量自动加3
			$fruit_data['fruit_id']		= $v['fruit_id'];
			$fruit_re					= $fruit_m->where("fruit_id='".$fruit_data['fruit_id']."'")->select();
			$fruit_data['buys']		= $fruit_re[0]['buys']+3;
			$fruit_m->save($fruit_data);
		}
		
		if( $orderid ){
			// 标记优惠券为使用状态
			$coupon_used	= $_SESSION['coupon_used'];
			$coupon_m		= M('user_coupon');
			$coupon_data	= array('is_used'=>1,'use_time'=>time(),'order_id'=>$orderid);
			$coupon_m->where("`coupon_id` IN($coupon_used)")->save($coupon_data);
			unset($_SESSION['coupon_used']);

			$result	= 'success';
			// 清空购物车
			$this->assign('carnum',0);
			unset($_SESSION['car']);
		}else{
			$result	= 'error';
		}
		$_SESSION['carnum'] =0;
        $this->assign('orderid',$orderid);
		$this->assign('result',$result);
		$this->display();
	}

	public function changecarnum(){
		$_SESSION['carnum'] = I('get.num');
		foreach($_SESSION['car'] as $k => $v){
			if($v['car_id'] ==I('get.fruit_id')){
				$_SESSION['car'][$k]['num'] = I('get.num2');
				break;
			}
		}
	}

	// 商品评论列表
	public function commonlist(){
		$fruit_id	= I('get.id');
		$comment_m	= M('order_detail');
		$commentlist= $comment_m->join("LEFT JOIN `order` ON order.order_id=order_detail.order_id")->where("`fruit_id`='".$fruit_id."' AND `commend`!='0'")->order("	order_detail_id desc")->select();

		// 处理名字，用张**蛋
		foreach( $commentlist as $k => $v ){
			$tmp	= $v['to_name'];
			$tmp_f	= substr($tmp,0,3);
			$tmp_l	= substr($tmp,-3);
			$commentlist[$k]['to_name']	= "{$tmp_f}**{$tmp_l}";
		}
		
		$fruit_m	= M('fruit');
		$fruit		= $fruit_m->where("`fruit_id`='".$fruit_id."'")->select();

		$this->assign('commentlist',$commentlist);
		$this->assign('fruit',$fruit[0]);
		$this->display();
	}
}
