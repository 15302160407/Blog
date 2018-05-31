<?php  
namespace app\common\model;
use think\Model;
class Author extends Model{
	public function getAuthorByUsername($username){
		$data=['username'=>$username];
		return $this->where($data)->find();
	}
}
?>