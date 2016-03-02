<?php

class UserAction extends AdminAction {

    function login() {
        if (isset($_POST['submit'])) {
            if(session('verify')==md5($_POST['verify'])) {
                $user = D('User');
                $user=$user->relation(TRUE)->where ("username='{$_POST['username']}'")->find();
            
                if($user['password']==$_POST['password']) {
                    session('userid',$user['id']);
                    session('username',$user['username']);
                    //用户权限
                    session('author',$user['Role']['author']);
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
