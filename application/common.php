<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 个人信息城市区域填入
 * @param $region
 * @param $flag
 * @return bool|string|void
 */
function getCityName($region,$flag){
    if(empty($region)){
        echo "参数传递不为空";
        return;
    }
    if(preg_match('/,/',$region)){
        $cityPath = explode(',',$region);
        $cityId = $cityPath[0];
        $seCityId = $cityPath[1];
    }else{
        $cityId = $region;
    }
    /**
     * flag = 0 return 一级城市id
     * flag = 1 return 二级城市名
     */
    if (!$flag){
        return $cityId;
    }else{
        $seCity = model('City')->get($seCityId);
        return $seCity->name;
    }
}

/**
 * 根据character_id身份输出
 * @param $id
 * @return string
 */
function showCharacter($id){
    $role = '';
    switch ($id){
        case 1 : $role = '管理员';break;
        case 2 : $role = '房东';break;
        case 3 : $role = '租客';break;
        default;
    }
    return $role;
}