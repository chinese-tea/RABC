<?php

class AdminAction extends CommonAction {

    public function _initialize() {
        parent::_initialize();

        $canVisitActFunc = unserialize(session('actionAndFunction'));
        //echo '<pre>';print_r($canVisitActFunc);exit;
        if (!isset($canVisitActFunc[MODULE_NAME])) {
            header("Content-type:text/html;charset=utf-8");
            echo '无权访问模块 ： ' . MODULE_NAME;
            exit;
        } else {
            if (!in_array(ACTION_NAME,$canVisitActFunc[MODULE_NAME])) {
                header("Content-type:text/html;charset=utf-8");
                echo '无权访问方法 ： ' . ACTION_NAME;
                exit;
            }
        }
    }

}
