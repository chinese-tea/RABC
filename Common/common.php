<?php

function tree($data, $pid = 0) {
    //static $tree = array();
    $tmp = array();
    foreach ($data as $v) {
        if ($v['pid'] == $pid) {
            $tmp[] = array(
                'id' => $v['id'],
                'name' => $v['name'],
                'pid' => $v['pid'],
                'child' => tree($data, $v['id'])
            );
        }
    }
    return $tmp;
}


function formatTree($data,$level=0){
    static $tree=array();
    foreach ($data as $v){
        if(!empty($v['child'])){
            $tree[]=array(
                'id'=>$v['id'],
                'name'=>$v['name'],
                'pid' => $v['pid'],
                'level'=>$level,
            );
            formatTree($v['child'],$level+1);
            
        }else{
            $tree[]=array(
                'id'=>$v['id'],
                'name'=>$v['name'],
                'pid' => $v['pid'],
                'level'=>$level,
            );
        }
    }
    return $tree;
}

function getTree($data){
    return formatTree(tree($data));
}