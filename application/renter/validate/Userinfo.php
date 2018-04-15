<?php

/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/11
 * Time: 16:00
 */
namespace app\renter\validate;

use think\Validate;

class Userinfo extends Validate
{
    protected $rule = [
        ['email', 'email', '邮箱格式不正确'],
        ['sex', 'number'],
        ['id', 'number'],
        ['mobile', 'number','电话号码必须为数字'],
    ];
    //场景设置
    protected $scene = [
        'add' => ['email','sex','id','mobile']
    ];
}