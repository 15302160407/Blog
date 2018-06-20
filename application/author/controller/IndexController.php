<?php
namespace app\author\controller;
use think\Controller;
class IndexController extends Controller//登录
{
  public function index()
  {

    // if(!input('?param.category_id')){
    //   $this->error("参数有误！");
    // }
    // $category_id=input('param.category_id');
    // $article=model('Article')->get($category_id);

    $authorId=session("authorId",'',"id");
    $myDetail=model("Author")->getAuthor($authorId);
    $this->assign('myDetail',$myDetail);

    $category=model('Category')->getCategory();
    $this->assign('category',$category);  
 
    $article=model('Article')->getAllArticle();
    $this->assign('article',$article);
    return $this->fetch();
  }

}
