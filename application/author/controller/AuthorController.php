<?php
namespace app\author\controller;
use think\Controller;
class AuthorController extends Controller//登录
{
  public function index()
  {
    $authorId=session("authorId",'',"id");
    $myDetail=model("Author")->getAuthor($authorId);
    $this->assign('myDetail',$myDetail);

    $category=model('Category')->getCategory();
    $this->assign('category',$category);  
 
    $article=model('Article')->getAllArticle();
    $this->assign('article',$article);
    return $this->fetch();
  }
  //
  public function getCategory(){
    //获取文章分类的id
    $data=input('post.');
    $categoryId=$data['category_id'];
    $article=model('Article')->getArticleList($categoryId);
    return $this->fetch();
    
  }

//注册
  public function register(){
    return $this->fetch();
  }

//保存注册信息
  public function save(){
    if(!request()->isPost()){
      $this->error("非法提交！");
    }
    $data=input('post.');
    $validate=validate('Author');
    if(!$validate->check($data)){
      $this->error($validate->getError());
    }
    $imageName=session('file','','logo');
    $authorData=[
    'username'=>$data['username'],
    'realname'=>$data['realname'],
    'password'=>$data['password'],
    'logo'=>$imageName,
    'code'=>$data['code'],
    'tel'=>$data['tel'],
    'email'=>$data['email'],
    'note'=>$data['note'],
    'create_time'=>time(),
    ];
    $authorId=model('Author')->add($authorData);
    session("authorId",$authorId,"id");
    if($authorId){
      $this->success("注册成功！","author/index");
    }
    else{
      $this->error("增加数据失败");
    }
  }

  public function ajaxUpload(){
        $file = $this->request->file('file');
        $fileName=$file->rule('date');
        //file是传文件的名称，这是webloader插件固定写入的。因为webloader插件会写入一个隐藏input，不信你们可以通过浏览器检查页面       
        $info =  $fileName->move(ROOT_PATH . 'public/static/images' . DS . 'authorLogo');
        session('file',$info->getSaveName(),'logo');
  }




//详细信息
    public function detail(){
        $auhtorId=session("authorId",'',"id");
        $myDetail=model("Author")->getAuthor($auhtorId);
        $this->assign('myDetail',$myDetail);
        return $this->fetch();
    }

//编辑
    public function edit(){
        $auhtorId=session("authorId",'',"id");
        $myDetail=model("Author")->getAuthor($auhtorId);
        $this->assign('myDetail',$myDetail);
       return $this->fetch();
    }
    public function update(){
        if(!request()->isPost()){
         $this->error("非法提交！");
      }
       $data=input('post.');
       $validate=validate('Author');
       if(!$validate->check($data)){
         $this->error($validate->getError());
       }
       $authorData=[
       'username'=>$data['username'],
       'realname'=>$data['realname'],
       'password'=>$data['password'],
       'code'=>$data['code'],
       'tel'=>$data['tel'],
       'email'=>$data['email'],
       'note'=>$data['note'],
       'update_time'=>time()
       ];
       $authorId=model('Author')->save($authorData,['id'=>intval($data['id'])]);
       if($authorId){
         $this->success("修改数据成功！","author/detail");
       }
       else{
         $this->error("修改数据失败！");
       }

     }


   }
