<?php
namespace Admin\Controller;
use Think\Controller;
// 管理员登录
class AdminController extends Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data	= I('post.');
		if( count($data) ){
			$username	= $data['username'];
			$password	= $data['password'];
			$passwordm	= MD5($password.C('ADMIN_SAIT'));
			$admin_m	= M('admin');
			$admin		= $admin_m->where("username='{$username}'")->select();
			
			if( $admin[0]['password'] != $passwordm ){
				$this->error('账号或密码错误');
			}else{
				$_SESSION['admin']	= $admin[0];
				$this->success('登录成功，稍等',C('ADMIN_INDEX'));
			}
		}else{
			$this->display();
		}
	}
}
?>