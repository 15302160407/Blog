<?php  
namespace app\common\model;
use think\Model;
class Category extends Model{
	public function add($data){
		$this->save($data);
		return $this->id;
	}
	public function getCategory(){
		return $this->paginate(10);
	}
	
}
?>