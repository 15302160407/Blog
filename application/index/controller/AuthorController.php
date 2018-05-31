<?php
namespace app\index\controller;
use think\Controller;
class AuthorController extends Controller
{
    public function AuthorLogin()
    {
        return $this->fetch();
    }
    public function check(){
    	if(!request()->isPost()){
    		$this->error("有错");
    	}
    	$data=input('post.');
    	$username=$data['username'];
    	$authorUsername=model("Admin")->getAuthorByUsername($username);
    	if(!$authorUsername){
    		$this->error("没有此用户！");
    	}
    	// if($adminUsername->password!=md5($data['password'])){
    	// 	$this->error("密码有误！");
    	// }
    	if($authorUsername->code!=$data['code']){
    		$this->error("密码加密码有误！");
    	}
    	$this->success('登录成功！');



    }
}
