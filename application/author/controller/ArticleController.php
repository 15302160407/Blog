<?php
namespace app\author\controller;
use think\Controller;
class ArticleController extends Base//登录
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
    $category=model('Category')->getCategory();
    $this->assign('myArticle',$myArticle);
    $this->assign('myDetail',$myDetail);
    $this->assign('category',$category);
    return $this->fetch();
  }
  //删除我的文章
  public function delete(){
    if(!input('?param.id')){
      $this->error("参数有误！");
    }
    $id=input('param.id');
    $article=model('Article')->get($id);
    if(!is_null($article)){
      if($article->delete()){
        $this->success("删除成功！",'article/myArticle');
      }
    }
    $this->error("删除有误！");
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
    $imageName=session('file','','articleLogo');//文章logo
    $articleData=[
    'title'=>$data['title'],
    'category_id'=>$data['category_id'],
    'description'=>$data['description'],
    'content'=>$data['content'],
    'logo'=>$imageName,
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
  public function ajaxUpload(){
    $file = $this->request->file('file');
        //file是传文件的名称，这是webloader插件固定写入的。因为webloader插件会写入一个隐藏input，不信你们可以通过浏览器检查页面       
    $info = $file->rule('date')->move(ROOT_PATH . 'public/static/images' . DS . 'articleLogo');
    session('file',$info->getSaveName(),'articleLogo');
  }
  //修改文章
  public function editArticle(){
    $auhtorId=session("authorId",'',"id");
    $categoryList=model('Category')->getCategory();
    $myDetail=model("Author")->getAuthor($auhtorId);
    if(!input('?param.id')){
      $this->error("参数有误！");
    }
    $article_id=input('param.id');
    $article=model("Article")->get($article_id);

    $this->assign('article',$article);
    $this->assign('myDetail',$myDetail);
    $this->assign('categoryList',$categoryList);
    return $this->fetch();
  }
  //更新文章
  public function update(){
    if(!request()->isPost()){
      $this->error("非法提交！");
    }
    $data=input('post.');
    $validate=validate('Article');
    if(!$validate->check($data)){
      $this->error($validate->getError());
    }
    $auhtorId=session("authorId",'',"id");
    $imageName=session('file','','articleLogo');//文章logo
    $articleData=[
    'title'=>$data['title'],
    'category_id'=>$data['category_id'],
    'description'=>$data['description'],
    'content'=>$data['content'],
    'logo'=>$imageName,
    'update_time'=>time(),
    "author_id"=>$auhtorId,
    ];
    $articleId=model('Article')->save($articleData,['id'=>intval($data['id'])]);
    if($articleId){
      $this->success("修改成功！","article/myarticle");
    }
    else{
      $this->error("修改数据失败");
    }
  }
  //获取我的文章列表内容
  public function getMyArticleList(){
    if(!input('?param.category_id')){
      $this->error("参数有误！");
    }
    $category_id=input('param.category_id');

    $auhtorId=session("authorId",'',"id");
    //我的
    $myDetail=model("Author")->getAuthor($auhtorId);
    $article=Model('Article')->getMyArticleList($auhtorId,$category_id);
    $category=model('Category')->getCategory();
    $this->assign('article',$article);
    $this->assign('myDetail',$myDetail);
    $this->assign('category',$category);
    return $this->fetch();
  }
}
