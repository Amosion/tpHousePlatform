<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/3/31
 * Time: 22:26
 */

namespace app\user\controller;

use think\Controller;

class Login extends Controller
{
    public function index()
    {
        //校验
        if (request()->isPost()) {
            $data = input('post.');
            //tp5验证
            $validate = validate('user');
            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
            }
            //通过用户名获取用户信息
            $ret = model('User')->get(['username' => $data['email']]);
            if (!$ret || $ret->status != 1) {
                $this->error('用户不存在');
            }
            //密码识别
            if ($ret->password != md5($data['password'] . $ret['code'])) {
                $this->error('密码错误');
            }
            //保存登录时间
            model('User')->updateById(['last_login_time' => time()], $ret->id);
            session('account', $ret, 'user');
            //不同角色登录
            $url = '';
            switch ($ret->character_id){
                case 1: $url = 'admin/index/index';break;
                case 2: $url = 'landlord/index/index';break;
                case 3: $url = 'renter/index/index';break;
                default : break;
            }
            return $this->success('登录成功', url($url));
        } else {
            //获取session
            $account = session('account', '', 'user');
            if ($account && $account->id) {
                //不同角色登录
                $url = '';
                switch ($account->character_id){
                    case 1: $url = 'admin/index/index';break;
                    case 2: $url = 'landlord/index/index';break;
                    case 3: $url = 'renter/index/index';break;
                    default : break;
                }
                return $this->redirect(url($url));
            }
            return $this->fetch();
        }
    }

    //退出登录
    public function logout()
    {
        session(null, 'user');
        return $this->redirect(url('login/index'));
    }


}