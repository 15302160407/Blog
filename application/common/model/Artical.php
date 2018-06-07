<?php  
namespace app\common\model;
use think\Model;
class Artical extends Model{
	public function add($data){
		$this->save($data);
		return $this->id;
	}
}
?>