<?php
namespace app\admin\controller;
use think\Controller;
class ArticalController extends Controller
{
	public function index(){
		$admin=Model("Admin")->getAdmin();
		$this->assign('admin',$admin);
		return $this->fetch();
	}

}
