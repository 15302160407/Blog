<?php  
namespace app\common\model;
use think\Model;
class Admin extends Model{
	public function getAdminByUsername($username){
		$data=['username'=>$username];
		return $this->where($data)->find();
	}
	public function getAdmin(){
		$data=['id'=>1];
		return $this->where($data)->find();
	}
}
?>