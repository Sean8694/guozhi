<?php
namespace Admin\Controller;
use Think\Controller;
// 订单模块
class IndexController extends Controller {
	public function __construct(){
		parent::__construct();
		admin_user_check();
	}
	
	// 首页设置菜单
	public function admin(){
		$list	= C('ADMIN_LIST');
		$this->assign('list',$list);
		$this->display();
	}

	public function index(){
		// 获得排序参数
		$filter		= I('get.filter') ? I('get.filter') : 1;
		$where		= " `status`='{$filter}' ";
		if( $filter==4 ){
			$limit="10";
		}
		
		// 查询全部订单（每次加载10个）
		$order_m		= M('order');
		$order_list		= $order_m->where($where)->order("order_id DESC")->limit($limit)->select();
		$order_status	= C('ORDER_STATUS');
		$order_location	= C('ADD_LOCATION');
		
		// 地理位置
		$order_location	= M('location_office');
		$order_location	= $order_location->select();
		//print_r($order_location);exit;

		// 查询每个订单的详情
		$order_detail_m	= M('order_detail');
		foreach( $order_list as $k=>$v ){
			// 状态替换
			$order_list[$k]['status']	= $order_status[$v['status']];
			// 收货区域替换
			//$order_list[$k]['to_location']	= $order_location[$v['to_location']];
			foreach( $order_location as $k2 => $v2 ){
				if( $v2['office_id'] == $v['to_location'] ){
					$order_list[$k]['to_location'] = $v2['office_name'];
					break;
				}
			}
			// 时间戳转换
			$order_list[$k]['ctime']	= date("Y-m-d H:i:s",$v['ctime']);
			// 已过时间
			$order_list[$k]['ptime']	= round((time()-$v['ctime'])/60,0);
			// 查询用户订单数量
			$user_id	= $v['user_id'];
			$detail_num	= $order_m->where("`user_id`='".$user_id."'")->field("count(1) num")->select();
			$order_list[$k]['detail_num']	= $detail_num[0]['num'];
			// 订单明细查询
			$order_list[$k]['detail']	= $order_detail_m->where("`order_id`='".$v['order_id']."'")->select();
			$detail_str	= '';
			foreach( $order_list[$k]['detail'] as $k2=>$v2 ){
				$detail_str	.= $v2['fruit_name'].'（￥'.$v2['price'].'*'.$v2['buys'].'）<br />';
			} 
			$order_list[$k]['detail']	= trim($detail_str,'<br />');
		}

		// 顶部菜单
		$list	= C('ADMIN_LIST');
		$this->assign('list',$list);

		$this->assign('listnow',CONTROLLER_NAME);	// 当前使用的controller
		$this->assign('order_status',$order_status);
		$this->assign('order_list',$order_list);
		$this->assign('order_list_count',count($order_list));
		$this->assign('filter',$filter);
		$this->display();
	}

	// 修改订单状态
	public function changestatus(){
		$data['order_id']	= I('get.orderid');
		$data['status']		= I('get.tostatus');
		$m	= M('order');
		if($m->save($data)){
			echo 1;exit;
		}
	}
}