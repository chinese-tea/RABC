<?php

class UserAction extends Action {

    function login() {
        if (isset($_POST['submit'])) {
            if(session('verify')==md5($_POST['verify'])) {
                $user = D('User');
                $user=$user->relation(TRUE)->where ("username='{$_POST['username']}'")->find();
            
                if($user['password']==$_POST['password']) {
                    session('userid',$user['id']);
                    session('username',$user['username']);
                    //用户权限
                    $authorString = $user['Role']['author'];
                    session('author',$authorString);
                    
                    //获取具体权限
                    $authorArr = M('Authority')->field('action,function')->where('id in ('.$authorString.')')->select();
                    
                    //用户可访问的控制器和方法
                    $tmp = array();
                    foreach($authorArr as $v){
                            if(!empty($v['action'])){
                                $tmp[$v['action']][]=$v['function'];  
                            }
                    }
                    //echo '<pre>';print_r($tmp);exit;
                    //END
                    
                    session('actionAndFunction',  serialize($tmp));
                    
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
    
    function logout(){
        unset($_SESSION);
        $this->redirect('User/login');
    }

}
