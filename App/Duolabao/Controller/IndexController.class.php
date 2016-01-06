<?php
namespace Duolabao\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		$requestId = I('get.reqid');
		$proc_order['order_id'] = $requestId;
		$proc_order['is_payed'] = 1;
		$proc_order['status'] = 1;
		$proc_order['payed_time'] = date("Y-m-d H:i:s",time());
		M('order')->save($proc_order);
	}

    public function callback() {
    	$reCode = I('post.reCode');
		$requestId = I('post.requestId');
		$description = I('post.description');
		$extraInfo = I('post.extraInfo');
		$hmac = I('post.hmac');
		if (C('DEBUG_MODE')) {
			$tmp_ary = array(
				'reCode' => $reCode,
				'requestId' => $requestId,
				'description' => $description,
				'extraInfo' => $extraInfo,
				'hmac' => $hmac,
			 );
			\Think\Log::write('POST PARAM:'.json_encode($tmp_ary));
		}
		if ($reCode == '1') {
			// 支付成功
			\Think\Log::write('订单'.$requestId.'支付成功');
			$paraMap = array(
				'reCode' => $reCode,
				'requestId' => $requestId,
				'description' => $description,
				'extraInfo' => $extraInfo,
			 );
			$dlb_payment = D('Duolabao/Payment', 'Service');
			$sign = $dlb_payment->getSign($paraMap);
			if ($sign == $hmac) {
				\Think\Log::write('订单'.$requestId.'验证签名成功');
			} else {
				\Think\Log::write('订单'.$requestId.'验证签名失败');
			}
			
			$cur_order = M('order')->where(['order_id'=>$requestId])->select();
			if (is_null($cur_order)) {
				\Think\Log::write('订单'.$requestId.'找不到了');
			} else {
				$proc_order['order_id'] = $requestId;
				$proc_order['is_payed'] = 1;
				$proc_order['status'] = 1;
				$proc_order['payed_time'] = date("Y-m-d H:i:s",time());
				M('order')->save($proc_order);
			}

		} else {
			\Think\Log::write('订单'.$requestId.'支付失败');
		}
		echo 'no';
    }
}