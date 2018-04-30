<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/30
 * Time: 20:29
 */

namespace app\admin\validate;

use think\Validate;

class Info extends Validate
{
    protected $rule = [
        ['id', 'number'],
        ['status', 'number|in:-1,0,1', '状态必须是数字|状态范围不合法'],
        ['listorder', 'number'],
    ];
    //场景设置
    protected $scene =[
        'status' => ['status','id'],
    ];

}