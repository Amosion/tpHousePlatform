<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/30
 * Time: 18:11
 */

namespace app\admin\controller;

use think\Controller;

class Info extends Controller
{
    protected $obj;
    public function _initialize()
    {
        $this->obj = model('info');
    }
    //房屋验证页面
    public function index(){
        $info = $this->obj->getHouseByStatus();
        return $this->fetch('',[
            'info' => $info
        ]);
    }

    /**
     * 房屋状态更改
     */
    public function status(){
        $data = input('get.');
        $validate = validate('Info');
        if(!$validate -> scene('status') -> check($data)) {
            $this -> error($validate->getError());
        }
        $res = $this->obj->save(['status' => $data['status']], ['id' => $data['id']]);
        if($res){
            $this->success('状态更新成功');
        }else{
            $this->error('状态更新失败');
        }
    }

}