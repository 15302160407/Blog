<?php
namespace app\common\validate;
use think\Validate;
class Author extends Validate{
	protected $rule=[
	['username','require|max:20','姓名不能为空|姓名不能超过20个字符'],
	['realname','require|max:20','真实姓名不能为空|真实姓名不能超过20个字符'],
	['password','require|max:30','密码不能为空|密码不能超过30个字符'],
	['code','require|max:10','密码加密码不能为空|密码加密码不能超过10个字符'],
	['tel','require|max:20','电话不能为空|电话不能超过20个字符'],
	['email','require|max:20','email不能为空|email不能超过20个字符'],
	];
	protected $scene=[	
	];
}
?>