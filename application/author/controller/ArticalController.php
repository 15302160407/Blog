<?php
namespace app\author\controller;
use think\Controller;
class ArticalController extends Controller//登录
{ 
//添加文章
  public function addArtical(){
    $auhtorId=session("authorId",'',"id");
    $myDetail=model("Author")->getAuthor($auhtorId);
    $this->assign('myDetail',$myDetail);
    return $this->fetch();
  }


  //我的文章
  public function myArtical(){
    $auhtorId=session("authorId",'',"id");
    $myDetail=model("Author")->getAuthor($auhtorId);
    $this->assign('myDetail',$myDetail);
    return $this->fetch();
  }
}
