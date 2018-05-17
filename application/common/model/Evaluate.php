<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/5/17
 * Time: 1:03
 */

namespace app\common\model;


class Evaluate extends BaseModel
{
    public function getEvalInfo($id = 0){
        $data = [
            'house_id' => $id,
            'status' => 1
        ];
        $order = [
            'create_time' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }

}