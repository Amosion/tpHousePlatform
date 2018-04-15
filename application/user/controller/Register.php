<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/3/31
 * Time: 22:26
 */

namespace app\user\controller;

use think\Controller;
use think\Db;

class Register extends Controller
{
    private $obj;
    public function _initialize(){
        $this->obj = model("User");
    }

    /**
     * 注册页面
     * @return mixed
     */
    public function index(){
        return $this->fetch();
    }

    /**
     * 注册提交
     */
    public function add(){
        //校验
        if(!request()->isPost()){
            $this->error('非post方式提交');
        }
        $data = input('post.');
        //tp5验证
        $validate = validate('user');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        //检测用户名是否存在
        $accountResult = $this->obj->get(['username' => $data['email']]);
        if($accountResult){
            $this->error('用户名已存在');
        }
        //账户信息入库
        //自动生成密码的校验字符串
        Db::startTrans();
        $data['code'] = mt_rand(100,10000);
        $userData = [
            'username' => $data['email'],
            'password' => md5($data['password'].$data['code']),
            'code' =>$data['code'],
            'character_id' => 3,
        ];
        $accountId = $this->obj->add($userData);
        $infoData = [
            'user_id' => $accountId,
            'email' => $data['email']
        ];
        $userinfoId = model('Userinfo')->add($infoData);
        if(!$accountId || !$userinfoId){
            Db::rollback();
            $this->error('注册失败');
        }else{
            Db::commit();
            $this->success('注册成功');
        }
    }

    /**
     * 用户名检测
     * @return string
     */
    public function checkName(){
        //校验
        if(!request()->isPost()){
            $this->error('非post方式提交');
        }
        //判断用户存在
        $data = input('post.');
        $accountResult = $this->obj->get(['username' => $data['email']]);
        if(!$accountResult){
            return json_encode(1);
        }
        return json_encode(0);
    }


}