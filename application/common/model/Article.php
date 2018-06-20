<?php  
namespace app\common\model;
use think\Model;
class Article extends Model{
	public function add($data){
		$this->save($data);
		return $this->id;
	}

	public function getArticle($author_id){
		$data=['author_id'=>$author_id];
		return $this->where($data)->select();
	}
	public function getMyArticle($id){
		$data=['category_id'=>$category_id];
		return $this->where($data)->find();
	}
	public function getAllArticle(){
		return $this->paginate(4);
	}
	public function getArticleList($categoryId){
		$data=['category_id'=>$categoryId];
		return $this->where($data)
		->paginate(4);
	}
	//我的文章分类
	public function getMyArticleList($author_id,$categoryId){
		$data=['author_id'=>$author_id,'category_id'=>$categoryId];
		return $this->where($data)
		->paginate(4);
	}
}
?>