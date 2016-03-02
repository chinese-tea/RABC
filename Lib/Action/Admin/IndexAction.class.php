<?php

class IndexAction extends AdminAction {

    public function index() {
        $this->display();
    }

    public function main() {
        $this->display();
    }

    public function top() {
        $this->display();
    }

    public function left() {
        $data = M('authority')->where('id in('.  session('author').')')->select();
        $tree = getTree($data);
        
        $list='';
        foreach($tree as $v){       
            if($v['level']==0){
                $list .= <<<EOF
                    </div>  
                    <h1 class="type"><a href="javascript:void(0)">{$v['name']}</a></h1>
                    <div class="content">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><img src="__PUBLIC__/Images/menu_top_line.gif" width="182" height="5" /></td>
                            </tr>
                        </table>
EOF;
            }elseif($v['level']==1){
                $list .=<<<EOF
                        <ul class="RM">
                            <li><a href="./cat_add.html" target="main">{$v['name']}</a></li>
                        </ul>
EOF;
            }
        }
        
        $list = ltrim($list, '</div> ');
        
        $this->assign('list',$list);
        $this->assign('tree',$tree);
        $this->display();
    }

}
