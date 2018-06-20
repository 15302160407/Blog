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

	public function article(){
		$article=model('Article')->getAllArticle();
		$admin=Model("Admin")->getAdmin();
		$this->assign('admin',$admin);
		$this->assign('article',$article);
		return $this->fetch();
	}
	//禁用用户
	public function forbidden(){
		if(!input('?param.id')){
			$this->error("参数有误！");
		}
		$id=input('param.id');		
		$data=[
			'status'=>2,
		];
		$author=model('Author')->save($data,['id'=>$id]);
		if($author){
     		$this->success("禁用成功!");
    	}
    	else{
    		$data=[
			'status'=>1,
			];
			$author=model('Author')->save($data,['id'=>$id]);
			$this->success("解禁成功！");
    	}
	}
	//禁用文章
	public function forbiddenArticle(){
		if(!input('?param.id')){
			$this->error("参数有误！");
		}
		$id=input('param.id');		
		$data=[
			'status'=>2,
		];
		$article=model('Article')->save($data,['id'=>$id]);
		if($article){
     		$this->success("禁用成功!");
    	}
    	else{
    		$data=[
			'status'=>1,
			];
			$article=model('Article')->save($data,['id'=>$id]);
			$this->success("解禁成功！");
    	}
	}


}
