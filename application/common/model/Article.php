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
}
?>