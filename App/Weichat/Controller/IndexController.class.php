<?php
namespace Weichat\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        // 第一次 token 验证  echo $_GET["echostr"];exit;
		// 调试内容
		/*
		$f	= fopen("./log.txt","w+");
		fwrite($f,'xxxxx'.date("Y-m-d H:i:s",time()));
		fclose($f);
		*/

        $this->responseMsg($GLOBALS["HTTP_RAW_POST_DATA"]);
        $this->show('wellcome to zhier！','utf-8');
    }

	// 自动登录跳转
	public function jumpto(){
		// 入口动作 allow action location orders
		$action		= I('get.action') ? I('get.action') : '';
		$re_code	= I('get.code');

		// 第一次进入，则获取用户头像等信息，第二次则直接获取openid即可
		// 先取得用户openid，判断是否已存在用户
		// 1. 换取用户的openid
		$re_info	= file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.C('WEICHAT_APPID').'&secret='.C('WEICHAT_SECRET').'&code='.$re_code.'&grant_type=authorization_code');
		$re_arr		= json_decode($re_info);
		session_start();
		$_SESSION['openid']	= $re_arr->openid;
		// 2. 判断是否已经注册
		$user_m		= M('user');
		$user		= $user_m->where("`wei_id`='".$_SESSION['openid']."'")->select();
		$face		= $user[0]['face'];
		// 3. 如果没有注册过，则尝试获取用户微信头像、昵称
		if( $face == 0 && !$re_code ){
			// 尝试获取用户微信头像等信息
			$re_info_detail	= file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$re_arr->access_token.'&openid='.$re_arr->openid.'&lang=zh_CN');
			$re_arr_detail	= json_decode($re_info_detail);
			if( !$re_arr_detail->openid ){
				// 跳转到授权页面
				$base_url	= urlencode(C('FRUIT_APP_URL'));
				redirect('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx659ec57ec2da708e&redirect_uri='.$base_url.'index.php%2FWeichat%2Findex%2Fjumpto%2Faction%2Flocation&response_type=code&scope=snsapi_base&state=123#wechat_redirect');
			}else{
				// 远程头像保存到本地
				// 太慢了，先用远程的头像
				/*
				$content = file_get_contents($re_arr_detail->headimgurl);
				$filename= md5($re_arr_detail->headimgurl).'.jpg';
				
				$facedir = C(ADMIN_UPLOAD).'/user_face/';	// 头像基础路径
				$today	 = date('Y-m-d',time());			// 今天日期
				$savedir = $facedir.$today;					// 保存路径
				$saveto	 = $savedir.'/'.$filename;			// 保存完整文件名
				$savedb	 = $today.'/'.$filename;			// 数据库保存
				if( !is_dir($savedir) ){
					mkdir($savedir);
				}

				file_put_contents($saveto, $content);
				$_SESSION['headimgurl']	= $savedb;
				*/

				$_SESSION['nickname']	= $re_arr_detail->nickname ? $re_arr_detail->nickname : '汁儿用户';
				$_SESSION['headimgurl']	= $re_arr_detail->headimgurl ? $re_arr_detail->headimgurl : '';
			}
		}

		$_SESSION['nickname']	= $re_arr_detail->nickname ? $re_arr_detail->nickname : '汁儿用户';
		$_SESSION['headimgurl']	= $re_arr_detail->headimgurl ? $re_arr_detail->headimgurl : '';
		
		// 跳转
		if( $action == 'orders' ){
			$this->redirect('Home/Index/index');
		}elseif( $action == 'sharecoupon' ){
			header("Location:".$_SESSION['share_coupon_url']);
		}else{
			$this->redirect('Fruit/Index/location');
		}
	}
    
    /* 微信接口 开始 */
    public function responseMsg($postStr){
		// 获得传入数据
		$postStr;

      	// 处理
		if (!empty($postStr)){
                // 解析数据
                libxml_disable_entity_loader(true);
              	$postObj		= simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername	= $postObj->FromUserName;
                $toUsername		= $postObj->ToUserName;
                $keyword		= trim($postObj->Content);
                $time			= time();
				$MsgType		= $postObj->MsgType;
				$EventKey		= $postObj->EventKey;
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";  
				// 登录链接基本
				$log_link	= $this->makeLoginLink($fromUsername);
				// 返回信息
				$app_url	= C('FRUIT_APP_URL');
				$contentStr = "汁儿Bistro@Work 致力于通过健康鲜榨的纯正果汁，为每个人提供创新的饮食方案与积极的生活方式。";
        }else {
        	$contentStr;
        }
		// 管理
		if( $keyword == '管理' ){
			$contentStr = "<a href='{$app_url}/index.php/Admin/Admin/'>管理后台</a>";
		}
        // 输出信息
        $msgType = "text";
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        echo $resultStr;
        

    }

    // 微信验证，暂时未用
    private function checkSignature()
    {       
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = 'xianguochaoren';
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

	// 生成登录链接
	private function makeLoginLink($weiId){
		$token	= 'gao_1e_2015';
		$weiId;
		$sign	= MD5("{$token}&{$weiId}");
		$return	= 'weiid/'.$weiId.'/sign/'.$sign;
		return $return;
	}

	// 活动链接
	public function fruitWorking(){
		header("Location:http://mp.weixin.qq.com/s?__biz=MzA3NTQ3MDY2OA==&mid=204136942&idx=1&sn=32eb64709524ea9eb8d0c9dd8b4a63d0#rd");
	}

}
