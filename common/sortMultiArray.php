<?php
/*-----------------------------------多维数据排序，并统计迭代次数---------------------------------------------*/
$students = array(
    256 => array('name' => 'Jon', 'grade' => 98.5),
    2 => array('name' => 'Vance', 'grade' => 85.1),
    9 => array('name' => 'Stephen', 'grade' => 94.0),
    364 => array('name' => 'Steve', 'grade' => 85.1),
    68 => array('name' => 'Rob', 'grade' => 74.6)
);
uasort($students, function($x, $y) {
    static $count = 1;
    $count++;
    return strcasecmp($x['name'], $y['name']);
});
uasort($students, function ($x, $y) {
    static $count = 1;
    $count++;
    return ($x['grade'] < $y['grade']);
});
