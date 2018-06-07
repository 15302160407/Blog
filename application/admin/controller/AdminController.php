<?php
namespace app\admin\controller;
use think\Controller;
class AdminController extends Controller
{
	public function my(){
		$admin=Model("Admin")->getAdmin();
		$this->assign('admin',$admin);
		return $this->fetch();
	}

	public function edit(){
		$admin=Model('Admin')->get(1);
		$this->assign('admin',$admin);
		return $this->fetch();
	}
	public function update(){
		if(!request()->isPost()){
		  $this->error("非法提交！");
		}
		$data=input('post.');
		$validate=validate('Admin');
		if(!$validate->check($data)){
			$this->error($validate->getError());
		}
		$adminData=[
			'username'=>$data['username'],
			'realname'=>$data['realname'],
			'password'=>$data['password'],
			'code'=>$data['code'],
			'update_time'=>time(),
		];
		$adminId=model('Admin')->save($adminData,['id'=>intval($data['id'])]);
		if($adminId){
			$this->success("修改成功！","admin/my");
		}
		else{
			$this->error("修改失败");
		}

	}

}
