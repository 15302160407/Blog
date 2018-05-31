<?php
namespace app\index\controller;
use think\Controller;
class AdminController extends Controller
{
    public function AdminLogin()
    {
        return $this->fetch();
    }
    public function check(){
    	if(!request()->isPost()){
    		$this->error("有错");
    	}
    	$data=input('post.');
    	$username=$data['username'];
    	$adminUsername=model("Admin")->getAdminByUsername($username);
    	if(!$adminUsername){
    		$this->error("没有此管理员！");
    	}
    	// if($adminUsername->password!=md5($data['password'])){
    	// 	$this->error("密码有误！");
    	// }
    	if($adminUsername->code!=$data['code']){
    		$this->error("密码加密码有误！");
    	}
    	$this->success('登录成功！');



    }
}
