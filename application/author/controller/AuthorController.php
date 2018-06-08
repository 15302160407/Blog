<?php
namespace app\author\controller;
use think\Controller;
class AuthorController extends Controller//登录
{
  public function index()
  {
    $auhtorId=session("authorId",'',"id");
    $myDetail=model("Author")->getAuthor($auhtorId);
    $this->assign('myDetail',$myDetail);
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
    $authorData=[
    'username'=>$data['username'],
    'realname'=>$data['realname'],
    'password'=>$data['password'],
    'code'=>$data['code'],
    'tel'=>$data['tel'],
    'email'=>$data['email'],
    'note'=>$data['note'],
    'create_time'=>time(),
    'update'=>time()
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
        $file = $this->request->file('file');//file是传文件的名称，这是webloader插件固定写入的。因为webloader插件会写入一个隐藏input，不信你们可以通过浏览器检查页面
        $info = $file->move(ROOT_PATH . 'public/static/images' . DS . 'authorLogo','');
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



    // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file('image');
    
    // 移动到框架应用根目录/public/uploads/ 目录下
    if($file){
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads','');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            // $this->success("上传图片成功！",'index/index');
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }


       $authorId=model('Author')->save($authorData,['id'=>intval($data['id'])]);
       if($authorId){
         $this->success("修改数据成功！","author/detail");
       }
       else{
         $this->error("修改数据失败！");
       }

     }

   }
