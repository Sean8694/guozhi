<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends Controller {
	public function __construct(){
		parent::__construct();
		admin_user_check();
	}

	// 产品列表
	function index(){
		// 分类列表
		$type_m		= M('fruit_type');
		$type		= $type_m->select();
		
		// 产品列表
		$typeid		= I('get.type') ? I('get.type') : 1;
		$product_m	= M('fruit');
		$product	= $product_m->where("`type_id`='{$typeid}'")->order("`order` DESC")->select();

		// 顶部菜单
		$list	= C('ADMIN_LIST');
		$this->assign('list',$list);

		$this->assign('listnow',CONTROLLER_NAME);	// 当前使用的controller
		$this->assign('typeid',$typeid);
		$this->assign('type',$type);
		$this->assign('product',$product);
		$this->display();
	}

	// 添加商品
	function add(){
		$post	= I('post.');
		$updir	= C('ADMIN_UPLOAD'); // 替换保存到数据库中的图片路径
		if( count($post) ){
			$data	= $post;
			// 上传文件处理
			$time	= time();
			$imgname= date("Y-m-d-H-i-s",$time).'-'.rand(100,999);
			if( $_FILES['img_s']['size'] ){
				// 移动文件
				$uploadfiles	= C('ADMIN_IMG').$imgname.'s'.'.jpg';
				move_uploaded_file($_FILES['img_s']['tmp_name'],$uploadfiles);
				$data['pic']	= str_ireplace($updir,'',$uploadfiles);
			}
			if( $_FILES['img_b']['size'] ){
				// 移动文件
				$uploadfileb	= C('ADMIN_IMG').$imgname.'b'.'.jpg';
				move_uploaded_file($_FILES['img_b']['tmp_name'],$uploadfileb);
				$data['picbig']	= str_ireplace($updir,'',$uploadfileb);
			}
			
			$data['detail']	= htmlspecialchars_decode($post['detail']);
			$data['ctime']	= $time;
			$data['utime']	= $time;
			// 保存数据
			$product_m		= M('fruit');
			$product		= $product_m->add($data);
			$this->success('新增成功', C('ADMIN_INDEX'));
		}else{
			// 分类
			$type_m		= M('fruit_type');
			$type		= $type_m->select();
			$this->assign('type',$type);
			$this->display();
		}
	}

	// 编辑产品
	function edit(){
		$id	= I('get.id');
		// 查询产品信息
		$product_m	= M('fruit');
		$product	= $product_m->where("`fruit_id`='{$id}'")->select();

		$post	= I('post.');
		$updir	= C('ADMIN_UPLOAD'); // 替换保存到数据库中的图片路径
		if( count($post) ){
			$data	= $post;
			// 上传文件处理
			$time	= time();
			$imgname= date("Y-m-d-H-i-s",$time).'-'.rand(100,999);
			if( $_FILES['img_s']['size'] ){
				// 移动文件
				$uploadfiles	= C('ADMIN_IMG').$imgname.'s'.'.jpg';
				move_uploaded_file($_FILES['img_s']['tmp_name'],$uploadfiles);
				// 删除原来的文件
				unlink($product[0]['pic']);
				$data['pic']	= str_ireplace($updir,'',$uploadfiles);
			}
			if( $_FILES['img_b']['size'] ){
				// 移动文件
				$uploadfileb	= C('ADMIN_IMG').$imgname.'b'.'.jpg';
				move_uploaded_file($_FILES['img_b']['tmp_name'],$uploadfileb);
				// 删除原来的文件
				unlink($product[0]['picbig']);
				$data['picbig']	= str_ireplace($updir,'',$uploadfileb);
			}
			
			$data['detail']	= htmlspecialchars_decode($post['detail']);
			$data['utime']	= $time;
			// 保存数据
			$product_m		= M('fruit');
			$product		= $product_m->save($data);
			$this->success('编辑成功', C('ADMIN_INDEX'));
		}else{
			// 附加信息
			$addinfo_m	= M('fruit_addinfo');
			$addinfo	= $addinfo_m->order("display_order desc")->where("`fruit_id`='$id' AND `display_order`!=0")->select();
			$this->assign('addinfo',$addinfo);

			// 分类
			$type_m		= M('fruit_type');
			$type		= $type_m->select();
			$this->assign('type',$type);
			$this->assign('product',$product[0]);
			$this->display();
		}
	}

	// 添加产品附加信息
	function addaddinfo(){
		$fruitid	= I('get.fruitid');
		$data		= I('post.');
		if( count($data) > 0 ){
			$addinfo_m	= M('fruit_addinfo');
			if( $addinfo_m->add($data) ){
				$this->assign('msg','添加成功');
			}else{
				$this->assign('msg','添加失败');
			}
			$fruitid	= I('post.fruit_id');
			$this->assign('fruitid',$fruitid);
			$this->display();
		}else{
			$this->assign('fruitid',$fruitid);
			$this->display();
		}
	}

	// 编辑产品附加信息
	function editaddinfo(){
		$add_id	= I('get.addid');
		$fruitid= I('get.fruitid');
		$data	= I('post.');
		$add_m	= M('fruit_addinfo');
		if( count($data) ){
			if( $add_m->save($data) ){
				$this->assign('msg','编辑成功');
			}else{
				$this->assign('msg','编辑失败');
			}
		}else{
			// 查询当前的信息
			$add	= $add_m->where("`id`='{$add_id}'")->select();
			$this->assign('add',$add[0]);
		}
		$this->assign('fruitid',$fruitid);
		$this->display();
		//print_r($add);exit;
	}
}
?>