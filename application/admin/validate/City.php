<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/3/23
 * Time: 21:27
 */
namespace app\admin\validate;

use think\Validate;

class City extends Validate
{
    protected $rule = [
        ['name', 'require|max:10', '城市名必须有|城名不能超过10字符'],
        ['parent_id', 'number'],
        ['id', 'number'],
        ['listorder', 'number'],
    ];
    //场景设置
    protected $scene = [
        'add' => ['name','parent_id','id']
    ];
}