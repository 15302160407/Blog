<?php
namespace app\author\controller;
use think\Controller;
class ArticleController extends Controller//登录
{ 

//添加文章
  public function addArticle(){
    $auhtorId=session("authorId",'',"id");
    $categoryList=model('Category')->getCategory();
    $myDetail=model("Author")->getAuthor($auhtorId);
    $this->assign('myDetail',$myDetail);
    $this->assign('categoryList',$categoryList);
    return $this->fetch();
  }


  //我的文章
  public function myArticle(){
    $auhtorId=session("authorId",'',"id");
    $myDetail=model("Author")->getAuthor($auhtorId);
    $myArticle=Model('Article')->getArticle($auhtorId);
    $this->assign('myArticle',$myArticle);
    $this->assign('myDetail',$myDetail);
    return $this->fetch();
  }

//添加文章
  public function save(){
      if(!request()->isPost()){
          $this->error("非法提交！");
      }
      $data=input('post.');
      $validate=validate('Article');
      if(!$validate->check($data)){
        $this->error($validate->getError());
    }
    $auhtorId=session("authorId",'',"id");
    $articleData=[
    'title'=>$data['title'],
    'category_id'=>$data['category_id'],
    'description'=>$data['description'],
    'content'=>$data['content'],
    'create_time'=>time(),
    "author_id"=>$auhtorId,
    ];
    $articleId=model('Article')->add($articleData);
    if($articleId){
        $this->success("添加成功！","article/myarticle");
    }
    else{
        $this->error("增加数据失败");
    }
}

//文章详细内容
  public function detail(){
    if(!input('?param.article_id')){
      $this->error("参数有误！");
    }
    $article_id=input('param.article_id');

    $myArticleDetail=Model('Article')->get($article_id);

    $auhtorId= $myArticleDetail->author_id;
    $category_id=$myArticleDetail->category_id;   

    $myDetail=model("Author")->getAuthor($auhtorId);
    $category=model("Category")->get($category_id);

    $this->assign('myArticleDetail',$myArticleDetail);
    $this->assign('myDetail',$myDetail);
    $this->assign('category',$category);
    return $this->fetch();
  }
}
