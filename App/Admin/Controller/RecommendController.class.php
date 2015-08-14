<?php
namespace Admin\Controller;
use Think\Controller;
class RecommendController extends Controller {
	public function __construct(){
		parent::__construct();
		admin_user_check();
	}

	// 评论列表
	function index(){
		$statusnow		= is_numeric(I('get.status')) ? I('get.status') : 1;
		// 分类列表
		$opinion_m		= M('');
		$opinion		= $opinion_m->query("SELECT f.name fruit_name,o.ctime,o.to_name,o.to_mobile,od.* FROM order_detail od LEFT JOIN `order` o ON o.order_id=od.order_id LEFT JOIN fruit f ON od.fruit_id = f.fruit_id WHERE od.`commend_status`='{$statusnow}'");

		// 顶部菜单
		$list	= C('ADMIN_LIST');
		$this->assign('list',$list);

		$this->assign('listnow',CONTROLLER_NAME);			// 当前使用的controller
		$this->assign('opinionstatus',C('ORDER_COMMEND_STATUS'));	// 意见状态
		$this->assign('statusnow',$statusnow);				// 意见状态
		$this->assign('opinion',$opinion);
		$this->display();
	}

	// 意见反馈回复
	function edit(){
		$data			= I('post.');
		if( count($data) ){
			$opinion_m		= M('order_detail');
			if( $opinion_m->save($data) ){
				$this->success('回复成功',C('ADMIN_RECOMMEND'));
			}else{
				$this->error('回复失败',C('ADMIN_RECOMMEND'));
			}
		}else{
			$opinion_id		= I('get.id');
			$opinion_m		= M('');
			$opinion		= $opinion_m->query("SELECT f.name fruit_name,o.ctime,o.to_name,o.to_mobile,od.* FROM order_detail od LEFT JOIN `order` o ON o.order_id=od.order_id LEFT JOIN fruit f ON od.fruit_id = f.fruit_id WHERE od.`order_detail_id`='{$opinion_id}'");
			
			$this->assign('opinionstatus',C('ORDER_COMMEND_STATUS'));	// 意见状态
			$this->assign('opinion',$opinion[0]);
			$this->display();
		}
	}
}
?>