<?php
namespace app\author\controller;
use think\Controller;
class ArticalController extends Controller//登录
{ 
//添加文章
  public function addArtical(){
    $auhtorId=session("authorId",'',"id");
    $categoryList=model('Category')->getCategory();
    $myDetail=model("Author")->getAuthor($auhtorId);
    $this->assign('myDetail',$myDetail);
    $this->assign('categoryList',$categoryList);
    return $this->fetch();
  }


  //我的文章
  public function myArtical(){
    $auhtorId=session("authorId",'',"id");
    $myDetail=model("Author")->getAuthor($auhtorId);
    $this->assign('myDetail',$myDetail);
    return $this->fetch();
  }

//添加文章
  public function save(){
      if(!request()->isPost()){
          $this->error("非法提交！");
      }
      $data=input('post.');
      $validate=validate('Artical');
      if(!$validate->check($data)){
        $this->error($validate->getError());
    }
    $articalData=[
    'title'=>$data['title'],
    'description'=>$data['description'],
    'content'=>$data['content'],
    'category_id'=>$data['category_id'],
    'create_time'=>$data['create_time'],
    ];
    $artiaclId=model('Artical')->add($articalData);
    if($artiaclId){
        $this->success("添加成功！","artical/myArtical");
    }
    else{
        $this->error("增加数据失败");
    }
}
}
