<?php
namespace app\common\validate;
use think\Validate;
class Admin extends Validate{
	protected $rule=[
	['username','require|max:20','姓名不能为空|姓名不能超过20个字符'],
	['realname','require|max:20','真实姓名不能为空|真实姓名不能超过20个字符'],
	['password','require|max:30','密码不能为空|密码不能超过30个字符'],
	['code','require|max:10','密码加密码不能为空|密码加密码不能超过10个字符']
	];
	protected $scene=[	
	];
}
?>