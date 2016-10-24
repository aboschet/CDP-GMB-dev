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
do {
    $controller_path .= '/'.$global_action[$i_controller_path++];
}while(is_dir(APP_PATH.'Controllers'.$controller_path));

$controller = '\\app\\Controllers'.str_replace('/', '\\', $controller_path).'Controller';
$action = isset($global_action[$i_controller_path]) ? $global_action[$i_controller_path] : 'index';
$numberParams = count($global_action)-$i_controller_path;
$params = (count($numberParams) === 0) ? null : array_slice($global_action, -$numberParams);
if(empty($params[$numberParams-1])) {unset($params[--$numberParams]);}


$controller = new $controller();
if(is_null($params)) {
    $controller->$action();
}
else {
    $controller->$action(extract($params));
}
