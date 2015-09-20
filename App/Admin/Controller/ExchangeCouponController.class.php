<?php
namespace Admin\Controller;
use Think\Controller;
class ExchangeCouponController extends Controller {
	public function __construct(){
		parent::__construct();
		admin_user_check();
	}

	function index(){
        // �����б�
		$Exchange_coupon		= M('Exchange_coupon');
		$coupons		= $Exchange_coupon->where('`order_id` < 1')->order('id desc')->select();
        
        // �����˵�
		$list	= C('ADMIN_LIST');
		$this->assign('list',$list);

		$this->assign('listnow',CONTROLLER_NAME);	// ��ǰʹ�õ�controller
        $this->assign('coupons',$coupons);
        $this->display();
    }

    public function add(){
        $data   = I('post.');
        $date   = date("Y-m-d H:i:s");
        if( $data ){
            $Exchange_coupon = M('Exchange_coupon');
            $data['ctime']= $date;
            $data['utime']= $date;
            $data['order_id']=0;
			$data['title']= strtolower($data['title']);
            if( $Exchange_coupon->add($data) ){
                $this->success('�����ɹ�','index');
            }
        }else{
            $this->display();
        }
    }
}