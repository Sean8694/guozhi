<?php
	/**
	* 管理后台，检查登录状态
	**/
	function admin_user_check(){
		if( $_SESSION['admin']['user_id'] < 1 ){
			header("Location:".C('ADMIN_LOGIN'));
			exit;
		}else{
		
		}
	}
?>