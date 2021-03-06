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
 * @return string|void
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
        $seCityId = '';
    }
    /**
     * flag = 0 return 一级城市id
     * flag = 1 return 二级城市id
     * flag = 2 return 二级城市name
     */
    $cityVal = '';
    switch ($flag){
        case 0:$cityVal = $cityId;break;
        case 1:$cityVal = $seCityId;break;
        case 2:
            if($seCityId){
                $seCity = model('City')->get($seCityId);
                $cityVal = $seCity->name;
            }
            break;
        case 3:
            if($cityId){
                $city = model('City')->get($cityId);
                $cityVal = $city->name;
            }
        default;
    }
    return $cityVal;
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
/**
 * 房屋状态
 * @param $status
 * @return string
 */
function status($status){
    if($status == 1){
        $str = '<span class="label label-success radius">正常</span>';
    }else if($status == 0){
        $str = '<span class="label label-warning radius">待审</span>';
    }else {
        $str = '<span class="label label-danger radius">删除</span>';
    }
    return $str;
}

/**
 * 户型转换显示
 * @param $type
 * @return string|void
 */
function houseTypeShow($type){
    if(empty($type)){
        echo "参数传递不为空";
        return;
    }
    $houseType = explode(',',$type);
    $str = $houseType[0].'室'.$houseType[1].'厅'.$houseType[2].'卫';
    return $str;
}

/**
 * 根据ownerid显示房东姓名
 * @param $ownerId
 */
function landlordName($ownerId){
    if(!$ownerId){
        echo '参数没有传递';
        return;
    }
    $user = model('Userinfo')->getUserInfo($ownerId);
    return $user->nickname;
}

/**
 * 户型显示
 * @param $type
 * @return string
 */
function showType($type){
    if(empty($type)){
        echo '参数不能为空';return;
    }
    $houseType = explode(',',$type);
    return $houseType[0].'室'.$houseType[1].'厅'.$houseType[2].'卫';
}

/**
 * 根据userId获取用户名和用户图片
 * flag = 0 用户名 / flag = 1 用户图片
 * @param $userId
 * @param $flag
 * @return mixed
 */
function evalUserShow($userId,$flag){
    if(!$userId){
        echo '参数没有传递';return;
    }
    $user = model('User')->getUserById($userId);
    if(!$flag){
        return $user->username;
    }else{
        return $user->image;
    }
}

/**
 * 显示房屋名字
 * @param $id
 * @return string|void
 */
function houseShowById($id){
    if(!$id){
        echo '参数没有传递';return;
    }
    $houseInfo = model('Info')->getHouseById($id);
    if(!$houseInfo){
        return '';
    }
    return $houseInfo->name;
}

/**
 * 租客预约状态
 * @param $status
 * @return string
 */
function orderStatus($status){
    $str = '';
    switch ($status){
        case 0 : $str = '<span class="label label-primary size-L radius">已预约</span>';break;
        case 1 : $str = '<span class="label label-success size-L radius">预约成功</span>';break;
        case -1 : $str = '<span class="label label-danger size-L radius">预约失败</span>';break;
        default;
    }
    return $str;
}
/**
 * 房东预约状态
 * @param $status
 * @return string
 */
function orderStatusBylandlord($status){
    $str = '';
    switch ($status){
        case 0 : $str = '<span class="label label-primary size-L radius">预约中</span>';break;
        case 1 : $str = '<span class="label label-success size-L radius">接受预约</span>';break;
        case -1 : $str = '<span class="label label-danger size-L radius">拒绝预约</span>';break;
        default;
    }
    return $str;
}

/**
 * 显示租客昵称
 * @param $renterId
 */
function renterName($renterId){
    if(!$renterId){
        echo '参数没有传递';
        return;
    }
    $user = model('Userinfo')->getUserInfo($renterId);
    return $user->nickname;
}
