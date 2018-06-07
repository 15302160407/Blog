<?php
namespace app\admin\controller;
use think\Controller;
class AuthorController extends Controller
{
	public function index(){
		$admin=Model("Admin")->getAdmin();
		$this->assign('admin',$admin);
		$author=Model("Author")->getAllAuthor();
		$this->assign('author',$author);
		return $this->fetch();
	}
	public function delete(){
		if(!input('?param.id')){
			$this->error("参数有误！");
		}
		$id=input('param.id');
		$author=model('Author')->get($id);
		if(!is_null($author)){
			if($author->delete()){
				$this->success("删除成功！",'author/index');
			}
		}
		$this->error("删除有误！");
	}


}
