<?php
namespace app\admin\controller;
use think\Controller;
class CategoryController extends Controller
{
	public function categoryList(){
		$admin=Model("Admin")->getAdmin();
		$category=Model('Category')->getCategory();
		$this->assign('admin',$admin);
		$this->assign('category',$category);
		return $this->fetch();
	}
	public function addCategoryList(){
		$admin=Model("Admin")->getAdmin();
		$this->assign('admin',$admin);
		return $this->fetch();
	}
	public function save(){
		if(!request()->isPost()){
			$this->error("非法提交！");
		}
		$data=input('post.');
		$categoryListData=[
		'categoryname'=>$data['categoryname'],
		'create_time'=>time()
		];
		$categoryId=Model('Category')->add($categoryListData);
		if($categoryId){
			$this->success('增加文章分类成功！','category/categoryList');
		}
		else{
			$this->error('增加数据失败！');
		}

	}

	public function delete(){
		if(!input('?param.id')){
			$this->error("参数有误！");
		}
		$id=input('param.id');
		$category=model('Category')->get($id);
		if(!is_null($category)){
			if($category->delete()){
				$this->success("删除成功！",'category/categoryList');
			}
		}
		$this->error("删除有误！");
	}

}
