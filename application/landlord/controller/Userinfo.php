<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/24
 * Time: 22:55
 */

namespace app\landlord\controller;

use think\Controller;

class Userinfo extends Controller
{
    /**个人信息页
     * @return mixed
     */
    public function index(){
        $citysinfo = model('City')->getCitysInfo();
        $user = session('account','','user');
        $userinfo = model('Userinfo')->getUserInfo($user->id);
        return $this->fetch('',[
            'citysInfo' => $citysinfo,
            'user' => $user,
            'userinfo' => $userinfo
        ]);
    }

    /**
     * 用户信息的修改
     */
    public function add(){
        //校验
        if(!request()->isPost()){
            $this->error('非post方式提交');
        }
        $data = input('post.');
        //tp5验证
        $validate = validate('Userinfo');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        //个人信息入库
        $infoData = [
            'user_id' => $data['user_id'],
            'nickname' => $data['nickname'] ? $data['nickname']:'',
            'sex' => $data['sex'],
            'region' => empty($data['se_city']) ? $data['city'] : $data['city'].','.$data['se_city'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'birthday' => $data['birthday']
        ];
        $info = model('Userinfo')->updateById($infoData,$data['id']);
        if($info){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 个人头像设置
     * @return mixed
     */
    public function portrait(){
        if(request()->post()){
            $data = input('post.');
            $info = model('User')->updateById(['image' => $data['image']],$data['id']);
            if($info){
                $this->success('保存成功');
            }else{
                $this->error('保存失败');
            }
        }else{
            $user = session('account','','user');
            return $this->fetch('',[
                'user' => $user
            ]);
        }
    }
}