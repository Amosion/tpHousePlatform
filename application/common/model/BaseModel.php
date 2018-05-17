<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/5/16
 * Time: 22:28
 */

namespace app\common\model;

use think\Model;

class BaseModel extends Model
{
    /**
     * 添加数据
     * @param array $data
     * @return mixed
     */
    public function add($data = []){
        if(!is_array($data)){
            exception('传递的数据不是数组');
        }
        $data['status'] = 1;
        $this->data($data)->allowField(true)->save();
        return $this->id;
    }

}