<?php
namespace miframe\core;

/**
 * 核心框架
 */
class Core
{
    static $config=[];


    function loadConfig(){
        self::$config = require CONFIG_PATH . '/global.php';
    }

    // 运行程序
    function run()
    {
        $includePaths=[
            APP_PATH . 'modules',
            VENDOR_PATH ,

        ];

        array_push($includePaths, get_include_path());
        set_include_path(join(PATH_SEPARATOR, $includePaths));

        $this->loadConfig();
        spl_autoload_register(array($this, 'loadClass'));
        $this->setReporting();
        $this->removeMagicQuotes();
        $this->route();
    }

    // 路由处理
    function route()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $urlArray = explode('/', $url);

        //模块名
        $moduleName=(isset($urlArray[0]) && !empty($urlArray[0])) ? strtolower($urlArray[0]) : 'index';

        // 获取控制器名
        $controllerName = (isset($urlArray[1]) && !empty($urlArray[1])) ? ucfirst($urlArray[1]) : 'Index';

        // 获取动作名
        $action = (isset($urlArray[2]) && !empty($urlArray[2])) ? $urlArray[2] : 'index';

        //获取URL参数
        $queryString = [];
        if(count($urlArray) >3){
            array_shift($urlArray);
            array_shift($urlArray);
            $queryString = $urlArray;
        }


        // 实例化控制器
        $controller = $moduleName.'\\controller\\'. $controllerName . 'Controller';
        $dispatch = new $controller($moduleName, $controllerName, $action);

        // 如果控制器存和动作存在，这调用并传入URL参数
        echo $controller, $action;
        if (method_exists($controller, $action)) {
            call_user_func_array(array($dispatch, $action), $queryString);
        } else {
            exit($controller . "控制器不存在");
        }
    }


    // 检测开发环境
    function setReporting()
    {
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', RUNTIME_PATH . 'logs/error.log');
        }
    }

    // 删除敏感字符
    function stripSlashesDeep($value)
    {
        if (is_array($value)){
            foreach ($value as &$v){
                if (is_array($v)){
                    return $this->stripSlashesDeep($v);
                }else{
                    return stripslashes($v);
                }
            }
        }
        return stripslashes($value);
    }

    // 检测敏感字符并删除
    function removeMagicQuotes()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = $this->stripSlashesDeep($_GET);
            $_POST = $this->stripSlashesDeep($_POST);
            $_COOKIE = $this->stripSlashesDeep($_COOKIE);
            $_SESSION = $this->stripSlashesDeep($_SESSION);
        }
    }

    // 自动加载控制器和模型类
    static function loadClass($class)
    {
        $file = str_replace('\\', '/', $class);
        $file .= '.php';

        $vendor_file = VENDOR_PATH . $file;
        if (file_exists($vendor_file)) {
            echo $vendor_file .'<br>';
            require $file;
        }

        foreach (self::$config['modules'] as $m){
            $controller =  APP_PATH . 'modules/'. $m .'/controller/' . $file;
            $model = APP_PATH . 'modules/'. $m .'/model/' . $file;
            if (file_exists($controller)) {
                echo $controller .'<br>';
                require $m .'/controller/' . $file;;
            }
            if (file_exists($model)) {
                echo $model .'<br>';
                require $m .'/model/' . $file;
            }
        }
    }
}