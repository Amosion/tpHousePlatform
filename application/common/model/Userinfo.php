<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/11
 * Time: 22:46
 */

namespace app\common\model;


class Userinfo extends User
{
    /**
     * 据user_id获取用户个人信息
     * @param $user_id
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getUserInfo($user_id){
        $data = [
            'user_id' => $user_id
        ];
        return $this->where($data)->find();
    }

}