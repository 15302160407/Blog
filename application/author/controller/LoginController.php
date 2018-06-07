<?php
namespace app\author\controller;
use think\Controller;
class LoginController extends Controller
{
    public function login()
    {
        return $this->fetch();
    }
    public function check(){
    	if(!request()->isPost()){
    		$this->error("有错");
    	}
    	$data=input('post.');
    	$username=$data['username'];
    	$authorUsername=model("Author")->getAuthorByUsername($username);
    	if(!$authorUsername){
    		$this->error("没有此用户！");
    	}
    	 //密码加密码
        $userPassword=$authorUsername->password.$authorUsername->code;
        session("authorId",$authorUsername->id,"id");
        session('my_user',$authorUsername,'my');
        if($userPassword!=$data['code']){
            $this->error("密码加密码有误！");
        }
        $this->success('登录成功！','author/index');

    }
    public function test(){
        return $this->fetch();
    }

    public function logout(){
        session(null,'id');
        $this->redirect('author/index');
    }
}
