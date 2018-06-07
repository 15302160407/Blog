<?php
namespace app\author\controller;
use think\Controller;

class Base extends Controller{
	private $account='';
	public function _initialize(){
		if(!$this->isLogin()){
			$this->redirect('login/login');
		}
		$user=$this->getLoginUser();
		$this->assign('user',$user);

	}
	public function isLogin(){
		$user=$this->getLoginUser();
		if($user&&$user->id){
			return true;
		}
		return false;
	}
	public function getLoginUser(){
		if(!$this->account){
			$this->account=session('my_user','','my');
		}
		return $this->account;
	}
}