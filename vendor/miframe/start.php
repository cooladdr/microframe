<?php


// 初始化常量
defined('FRAME_PATH') or define('FRAME_PATH', __DIR__.'/');

require FRAME_PATH . '/core/Core.php';


// 实例化核心类
$fast = new miframe\core\Core();
//$fast = new Core();
$fast->run();