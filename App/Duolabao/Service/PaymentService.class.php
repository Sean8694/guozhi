<?php
namespace Duolabao\Service;
use Think\Model;
class PaymentService {
	public function getCf() {
		return C('DUOLABAO_GEN_ORDER_URL');
	}
	public function genDLBPayUrl($order_id, $price) {
		$paraMap = array(
			'cmd' => 'CREATEORDER',
			'customerNumber' => C('CUSTOMER_NUMBER'),
			'shopNumber' => C('SHOP_NUMBER'),
			'machineNumber' => '1',
			'requestId' => $order_id,
			'amount' => $price,
			'callbackUrl' => C('CALLBACK_URL'),
			'description' => 'desc',
			'extraInfo' => 'extra',
			);
		$duolabao_url = C('DUOLABAO_GEN_ORDER_URL').'?'.$this->formatBizQueryParaMap($paraMap, true).'&hmac='.$this->getSign($paraMap);
		\Think\Log::write('duolabao_url:'.$duolabao_url, 'info');
		$duolabao_rsp = file_get_contents($duolabao_url);
		\Think\Log::write('duolabao_rsp:'.$duolabao_rsp, 'info');
		$encode_pay_url = $this->getPayUrl($duolabao_rsp);
		\Think\Log::write('encode_pay_url:'.$encode_pay_url, 'info');
		$duolabao_pay_url = $this->decrypt($encode_pay_url, C('DUOLABAO_SECRET'));
		\Think\Log::write('duolabao_pay_url:'.$duolabao_pay_url, 'info');
		return $duolabao_pay_url;
	}




	public function formatBizQueryParaMap($paraMap,$url='true') {
		$buff = "";
		if($url == 'true') {
			foreach ($paraMap as $k => $v) {
				$buff .= $k . "=" . $v . "&";
			}

			if (strlen($buff) > 0) {
				$buff = substr($buff, 0, strlen($buff)-1);
			}
		} else {
			foreach ($paraMap as $v) {
				$buff .= $v;
			}
		}

		return $buff;
	}

	public function getSign($Obj) {
		$key = C('DUOLABAO_SECRET');
		$String = $this->formatBizQueryParaMap($Obj, 'false');
		$Code = hash_hmac('md5', $String, $key);
		return $Code;
	}

	public function getPayUrl($text) {
		$txt_ary = split('&', $text);
		foreach ($txt_ary as $key => $value) {
			if (substr($value, 0, 4) == 'url=') {
				return substr($value, 4);
			}
		}
		return '';
	}


	public function decrypt($url, $key)
	{	

    	//$brand = $_SESSION['brand'];
		//$key = M('User')->where(array('id'=>$brand))->getField('dlpaykey');
		//$url = 多啦宝返回的支付链接
		$key = substr($key,0,24);//支付密钥商户
		$url = urldecode($url);//url解码
		$url = str_replace(' ', '+', $url);//替换空格

        $encrypted = base64_decode($url);//二进制转换
        $td = mcrypt_module_open(MCRYPT_3DES,'','ecb','');
        $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td),MCRYPT_RAND);
        $ks = mcrypt_enc_get_key_size($td);
        @mcrypt_generic_init($td, $key, $iv);
        $decrypted = mdecrypt_generic($td, $encrypted);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $y=$this->pkcs5_unpad($decrypted);
        return $y;
    }


    public function pkcs5_unpad($text)
    {
    	$pad = ord($text{strlen($text)-1});
    	if ($pad > strlen($text)) 
    	{
    		return false;
    	}
    	if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
    	{
    		return false;
    	}
    	return substr($text, 0, -1 * $pad);
    }
}