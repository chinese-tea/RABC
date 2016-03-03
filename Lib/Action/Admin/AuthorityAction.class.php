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

    function edit() {
        $author = M('Authority');

        if (isset($_POST['submit'])) {
            //echo '<pre>';print_r($_POST);exit;
            $author->create();
            if ($author->save()) {
                $this->success('修改成功', '__URL__/index');
            } else {
                $this->error('修改失败');
            }
        } else {
            $id = $_GET['id'];
            $data = $author->where('id=' . $id)->find();

            $tmp = $author->select();
            $tree = getTree($tmp);

            $this->assign('id', $id);
            $this->assign('catlist', $tree);
            $this->assign('data', $data);
            $this->display();
        }
    }

    function del() {
        $id = $_GET['id'];
        if (M('Authority')->where('id=' . $id)->delete()) {
            $this->success('删除成功', '__URL__/index');
        } else {
            $this->error('删除失败', '__URL__/index');
        }
    }

}
