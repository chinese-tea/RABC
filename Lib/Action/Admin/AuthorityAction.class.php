<?php

class AuthorityAction extends Action {

    function index() {
        $this->display();
    }

    function add() {
        $author=M('Authority');
        if(isset($_POST['submit'])){
            $author->create();
            if($author->add()){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
            
        }else{
           $data=$author->where('pid=0')->select(); 
           $this->assign('data',$data);
           $this->display(); 
        }   
    }

}
