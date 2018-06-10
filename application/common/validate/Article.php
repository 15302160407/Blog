<?php
namespace app\common\validate;
use think\Validate;
class Article extends Validate{
	protected $rule=[
		['title','require|max:50','标题不能为空|标题不能超过50个字符'],
		['description','require|max:250','描述不能为空|描述不能超过250个字符'],
		['content','require','内容不能为空'],
	];
	protected $scene=[
	];
}
?>