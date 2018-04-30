<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/10
 * Time: 22:52
 */

namespace app\api\controller;

use think\Controller;

class City extends Controller
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model('City');
    }

    public function getCitysByParentId()
    {
        if(!request()->isPost()){
            $this->error('非post方式提交');
        }
        $id = input('post.id');
        if (!$id) {
            $this->error('id不合法');
        }
        //tp5 validate
        //通过id获取二级城市
        $citys = $this->obj->getCitysInfo($id);
        if (!$citys) {
            return show(0, "error");
        }
        return show(1, "success", $citys);

    }

}