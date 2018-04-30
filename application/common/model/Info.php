<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/30
 * Time: 0:14
 */

namespace app\common\model;

use think\Model;

class Info extends Model
{
    /**
     * 房屋信息添加
     * @param array $data
     * @return mixed
     */
    public function add($data = []){
        if(!is_array($data)){
            exception('传递的数据不是数组');
        }
        $data['status'] = 0;
        $this->data($data)->allowField(true)->save();
        return $this->id;
    }

}