<?php

class CommonAction extends Action{
    public function _initialize(){
        $user=session('userid');
        if(!isset($user)){
            $this->redirect('User/login');
        }
    }
}

