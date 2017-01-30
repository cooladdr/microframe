<?php
/*-----------------------------------无限级目录列表---------------------------------------------*/


function make_list (&$list, $pIndx) {
    if(!isset($list[$pIndx])){
        return [];
    }

    foreach ($list[$pIndx] as &$item) {
        $childen=[];
        if(isset($list[$item['id']])){
            $childen=make_list($list, $item['id']);
            unset($list[$item['id']]);
        }
        $item['childen']=$childen;
    }

    return $list[$pIndx];
}

function mkList($items){
    $list = array();
    //先按父id分类
    foreach ($items as $item){
        $list[$item['parent_id']][]=$item;
    }
    make_list($list, 0);
    return $list;
}


function binSearch($arr, $low, $high, $val){
    if ($low > $high){
        return -1;
    }

    $mid = intval(($low+$high)/2);

    if($arr[$mid] == $val){
        return $mid;
    }

    if($arr[$mid] > $val){
        return binSearch($arr, $low, $mid-1, $val);
    }else{
        return binSearch($arr, $mid+1, $high, $val);
    }

}


