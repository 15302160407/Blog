<?php
namespace app\admin\controller;
use think\Controller;
class AdminController extends Controller
{
	public function index(){
		$admin=Model("Admin")->getAdmin();
		$this->assign('admin',$admin);
		return $this->fetch();
	}

}
