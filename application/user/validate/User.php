<?php

/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/1
 * Time: 20:29
 */
namespace app\user\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        ['email', 'require|email', '邮箱名必须有|邮箱格式错误'],
        ['password','min:6|max:13','密码至少6位|密码至多13位'],
        ['id', 'number'],
    ];
    //场景设置
    protected $scene = [
        'add' => ['email','password','id'],
    ];

}