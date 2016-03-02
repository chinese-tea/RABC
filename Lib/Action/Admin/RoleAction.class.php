<?php

class RoleAction extends AdminAction {

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
            $author = implode(',',$_POST['author']);
            
            $_POST['author'] = $author;
            $role->create();
            if ($role->add()) {
                $this->success('添加成功', 'index');
            } else {
                $this->error('添加失败');
            }
        } else {
            $author = M('Authority');
            $data = $author->select();
            
            $role = M('Role');
            $role = $role->select();
            
            $tree = getTree($data);
            
            $this->assign('catlist', $tree);
            $this->assign('rolelist', $role);

            $this->display();
        }
    }
    
    /*
     * 获取角色的权限,需用post传入角色id
     */
    function getAuthor(){
        $id=$_POST['id'];
        $data=M('Role')->field('author')->where('id='.$id)->find();
        $data=explode(',', $data['author']);
        $this->ajaxReturn($data);
    }

}
