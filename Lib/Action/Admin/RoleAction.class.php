<?php

class RoleAction extends Action {

    function index() {
        $role = M('Role');
        $data = $role->select();
        $tree = getTree($data);
        $this->assign('catlist', $tree);
        $this->display();
    }

    function add() {
        $role = M('Role');
        if (isset($_POST['submit'])) {
            $role->create();
            if ($role->add()) {
                $this->success('添加成功', 'index');
            } else {
                $this->error('添加失败');
            }
        } else {
            $author = M('Authority');
            $data = $author->select();

            $tree = getTree($data);
            //header('Content-type:text/html;charset=utf-8');
            //echo '<pre>';print_r($tree);exit;
            $this->assign('catlist', $tree);

            $this->display();
        }
    }

}
