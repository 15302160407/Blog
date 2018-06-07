<?php  
namespace app\common\model;
use think\Model;
class Author extends Model{
	public function getAuthorByUsername($username){
		$data=['username'=>$username];
		return $this->where($data)->find();
	}
	public function add($data){
		$this->save($data);
		return $this->id;
	}
	public function getAuthor($auhtorId){
		$data=['id'=>$auhtorId];
		return $this->where($data)->find();
	}
	public function getAllAuthor(){
		return $this->paginate(10);
	}
	// public function save(){
		
	// }
}
?>