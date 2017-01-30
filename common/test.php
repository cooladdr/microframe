<?php
require './functions.php';
require  './binSearch.php';

$items = [
    ['id'=>1, 'parent_id'=>0, 'name'=>''],
    ['id'=>2, 'parent_id'=>0, 'name'=>''],
    ['id'=>3, 'parent_id'=>0, 'name'=>''],
    ['id'=>4, 'parent_id'=>3, 'name'=>''],
    ['id'=>5, 'parent_id'=>3, 'name'=>''],
    ['id'=>6, 'parent_id'=>3, 'name'=>''],
    ['id'=>7, 'parent_id'=>6, 'name'=>''],
    ['id'=>8, 'parent_id'=>7, 'name'=>''],
    ['id'=>9, 'parent_id'=>8, 'name'=>''],
    ['id'=>10, 'parent_id'=>9, 'name'=>''],
];

//echo json_encode(mkList($items));

echo  binSearch([1,2,3,4,5,6,7,8,9], 0,8, 22);

