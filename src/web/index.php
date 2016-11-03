<?php
define('ROOT_PATH', __DIR__);
define('APP_PATH', ROOT_PATH.'/app/');
define('SYSTEM_PATH', ROOT_PATH.'/system/');
define('VIEWS_PATH', ROOT_PATH.'Views/');
define('MODELS_PATH', ROOT_PATH.'Models/');

require SYSTEM_PATH . 'App.php';
use system\App;

App::load();



$global_action = isset($_GET['p']) ? explode('/', $_GET['p']) : null;
$controller_path = '';
$i_controller_path = 0;
if(!is_null($global_action)) {
    do {
        $controller_path .= '/'.$global_action[$i_controller_path++];
    }while($global_action && is_dir(APP_PATH.'Controllers'.$controller_path));
}
else {
    $controller_path = '/'.App::getConfig('default_controller');
}
$controller = '\\app\\Controllers'.str_replace('/', '\\', $controller_path).'Controller';
$action = isset($global_action[$i_controller_path]) && !(empty($global_action[$i_controller_path])) ? $global_action[$i_controller_path] : App::getConfig('default_function');
$numberParams = count($global_action)-$i_controller_path;
$params = ($numberParams === 0) ? null : array_slice($global_action, -$numberParams+1);

//Delete the last empty params
if(!is_null($params) && empty($params[$numberParams-1])) {
    unset($params[--$numberParams]);
}

$controller = new $controller();
try {
    if(method_exists($controller, $action)) {
        if (is_null($params)) {

            $controller->$action();
        } else {
            call_user_func_array(array($controller, $action), $params);
        }
    }
    else {
        throw new Exception("notFound");
    }
} catch (Exception $e) {

    $controller->{$e->getMessage()}();
}