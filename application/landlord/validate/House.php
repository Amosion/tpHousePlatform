<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/29
 * Time: 23:05
 */

namespace app\landlord\validate;

use think\Validate;

class House extends Validate
{
    protected $rule = [
        ['name', 'require', '名字为必填项'],
        ['description', 'require','描述为必填项'],
        ['price', 'number','价格必须为数字'],
        ['area', 'number','面积必须为数字'],
        ['type_shi', 'number','室必须为数字'],
        ['type_ting', 'number','厅必须为数字'],
        ['type_wei', 'number','卫必须为数字'],
        ['orient', 'require', '房屋方位为必填项'],
        ['address', 'require', '地址为必填项'],
    ];
    //场景设置
    protected $scene = [
        'add' => ['name','description','price','area','type_shi','type_ting','type_wei','orient','address']
    ];

}