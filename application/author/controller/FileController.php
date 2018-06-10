<?php
namespace app\author\controller;
use think\Controller;

class FileController extends Controller{
	public function index(){
		return $this->fetch();
	}
	//异步
	public function ajaxIndex(){
		return $this->fetch();
	}
	public function upload(){
    // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file('image');
    
    // 移动到框架应用根目录/public/uploads/ 目录下
    if($file){
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads','');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            $this->success("上传图片成功！");
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
}

 function ajaxUpload(){
        $file = $this->request->file('file');//file是传文件的名称，这是webloader插件固定写入的。因为webloader插件会写入一个隐藏input，不信你们可以通过浏览器检查页面
        $info = $file->move(ROOT_PATH . 'public' . DS . 'ajaxUploads','');
    }
}