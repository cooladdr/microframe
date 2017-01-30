<?php

// 应用目录为当前目录
define('APP_PATH', dirname(__DIR__).'/app');

define('CONFIG_PATH', dirname(__DIR__).'/config');

define('PUPLIC_PATH', dirname(__DIR__).'/public');

define('RUNTIME_PATH', dirname(__DIR__).'/runtime');

define('VENDOR_PATH', dirname(__DIR__).'/vendor');

// 开启调试模式
define('APP_DEBUG', true);

//引入composer自动加载
require VENDOR_PATH . '/autoload.php';

// 引入noahbuscher/macaw路由配置
//require VENDOR_PATH.'/miframe/start.php';

require CONFIG_PATH . '/routes.php';