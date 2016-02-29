<?php

class UserAction extends Action {

    function login() {
        if (isset($_POST['submit'])) {
            if(session('verify')==md5($_POST['verify'])) {
                $user = M('User');
                $user=$user->where ("username='{$_POST['username']}'")->find();
                if($user['password']==$_POST['password']) {
                    session('userid',$user['id']);
                    session('username',$user['username']);
                    $this->success('登录成功', __GROUP__.'/Index/index');
                } else {
                   $this->error('用户名或密码错误'); 
                }
            }  else {
                $this->error('验证码错误');
            }
        } else {
            $this->display();
        }
    }

    function verify() {
        import('ORG.Util.Image');
        echo Image::buildImageVerify();
    }

}
