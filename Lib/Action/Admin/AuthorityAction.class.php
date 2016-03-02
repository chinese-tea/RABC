<?php

class AuthorityAction extends AdminAction {

    function index() {
        $author = M('Authority');
        $data = $author->select();
        $tree = getTree($data);
        $this->assign('catlist', $tree);
        $this->display();
    }

    function add() {
        $author = M('Authority');
        if (isset($_POST['submit'])) {
            $author->create();
            if ($author->add()) {
                $this->success('添加成功', 'index');
            } else {
                $this->error('添加失败');
            }
        } else {
            $data = $author->select();

            $tree = getTree($data);
            //header('Content-type:text/html;charset=utf-8');
            //echo '<pre>';print_r($tree);exit;
            $this->assign('catlist', $tree);

            $this->display();
        }
    }

}
