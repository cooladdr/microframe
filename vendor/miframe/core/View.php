<?php
namespace miframe\core;

/**
 * 视图基类
 */

class View
{
    protected $variables = array();
    protected $_module;
    protected $_controller;
    protected $_action;

    function __construct($module, $controller, $action)
    {
        $this->_module=$module;
        $this->_controller = $controller;
        $this->_action = $action;
    }

    /** 分配变量 **/
    function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /** 渲染显示 **/
    function render()
    {
        extract($this->variables);
        $defaultHeader = APP_PATH . 'views/layout/header.php';
        $defaultFooter = APP_PATH . 'views/layout/footer.php';
        $controllerHeader = APP_PATH . 'modules/'. $this->_module .'/views/layout/header.php';
        $controllerFooter = APP_PATH . 'modules/'. $this->_module .'/views/layout/footer.php';

        // 页头文件
        if (file_exists($controllerHeader)) {
            include($controllerHeader);
        } else {
            include($defaultHeader);
        }

        // 页内容文件
        include (APP_PATH . 'modules/' . $this->_module . '/views/'. $this->_controller .'/' . $this->_action . '.php');

        // 页脚文件
        if (file_exists($controllerFooter)) {
            include($controllerFooter);
        } else {
            include($defaultFooter);
        }
    }
}