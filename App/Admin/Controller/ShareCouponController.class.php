<?php
namespace Admin\Controller;
use Think\Controller;
class ShareCouponController extends Controller {
	public function __construct(){
		parent::__construct();
		admin_user_check();
	}

	function index(){
        // 分类列表
		$share_coupon		= M('share_coupon');
		$coupons		= $share_coupon->where('`order_id` < 1')->order('id desc')->select();
        
        // 顶部菜单
		$list	= C('ADMIN_LIST');
		$this->assign('list',$list);

		$this->assign('listnow',CONTROLLER_NAME);	// 当前使用的controller
        $this->assign('coupons',$coupons);
        $this->display();
    }

    public function add(){
        $data   = I('post.');
        $date   = date("Y-m-d H:i:s");
        if( $data ){
            $share_coupon = M('share_coupon');
            $data['ctime']= $date;
            $data['utime']= $date;
            $data['order_id']=0;
            if( $share_coupon->add($data) ){
                $this->success('新增成功','index');
            }
        }else{
            $this->display();
        }
    }
}