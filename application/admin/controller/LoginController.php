<?php
namespace app\admin\controller;
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

        $captcha=$data['captcha'];
        if(!captcha_check($captcha)){
            $this->error("验证码有有误！");
        }
        $username=$data['username'];
        $adminUsername=model("Admin")->getAdminByUsername($username);
        if(!$adminUsername){
            $this->error("没有此用户！");
        }
        session('my_user',$adminUsername,'my');
         //密码加密码
        // $userPassword=$adminUsername->password.md5($adminUsername->code);
        // if($userPassword!=md5($data['code'])){
        //     $this->error("密码加密码有误！");
        // }
        $this->success('登录成功','category/categoryList');

    }
     public function logout(){
        session(null,'id');
        $this->redirect('login/login');
    }

}
