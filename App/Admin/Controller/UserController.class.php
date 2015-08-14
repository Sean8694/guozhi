<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
	public function __construct(){
		parent::__construct();
		admin_user_check();
	}

	// 用户列表
	function index(){
		// 分类列表
		$user_m		= M('user');
		$user		= $user_m->query('
SELECT
	u.*, o.office_name,
	a.mobile,
	a.location_detail,
	FROM_UNIXTIME(od.ctime,"%Y-%m-%d") lastbuy,
	COUNT(od.user_id) allbuy
FROM
	`user` u
LEFT JOIN user_address a ON u.user_id = a.user_id
LEFT JOIN location_office o ON a.location = o.office_id
LEFT JOIN `order` od ON u.user_id=od.user_id
GROUP BY u.user_id
		');
		//print_r($user);exit;

		// 顶部菜单
		$list	= C('ADMIN_LIST');
		$this->assign('list',$list);

		$this->assign('listnow',CONTROLLER_NAME);	// 当前使用的controller
		$this->assign('user',$user);
		$this->display();
	}
}
?>