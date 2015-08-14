<?php
namespace Admin\Controller;
use Think\Controller;
class OpinionController extends Controller {
	public function __construct(){
		parent::__construct();
		admin_user_check();
	}

	// 反馈列表
	function index(){
		$statusnow		= I('get.status');
		// 分类列表
		$opinion_m		= M('opinion');
		$opinion		= $opinion_m->query("SELECT u.name,o.* FROM opinion o LEFT JOIN user u ON o.user_id=u.user_id WHERE o.`status`='{$statusnow}' order by `opinion_id` desc");

		// 顶部菜单
		$list	= C('ADMIN_LIST');
		$this->assign('list',$list);

		$this->assign('listnow',CONTROLLER_NAME);			// 当前使用的controller
		$this->assign('opinionstatus',C('OPINION_STATUS'));	// 意见状态
		$this->assign('statusnow',$statusnow);				// 意见状态
		$this->assign('opinion',$opinion);
		$this->display();
	}

	// 意见反馈回复
	function edit(){
		$data			= I('post.');
		if( count($data) ){
			$opinion_m		= M('opinion');
			$data['rtime']	= time();
			$data['status']	= 1;
			if( $opinion_m->save($data) ){
				$this->success('回复成功',C('ADMIN_OPINION'));
			}else{
				$this->error('回复失败',C('ADMIN_OPINION'));
			}
		}else{
			$opinion_id		= I('get.id');
			$opinion_m		= M('opinion');
			$opinion		= $opinion_m->query("SELECT u.name,o.* FROM opinion o LEFT JOIN user u ON o.user_id=u.user_id WHERE `opinion_id`='{$opinion_id}'");
			
			$this->assign('opinion',$opinion[0]);
			$this->display();
		}
	}
}
?>