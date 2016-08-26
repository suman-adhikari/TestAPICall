<?php
/**
 * Created by PhpStorm.
 * User: Suman
 * Date: 2/2/2016
 * Time: 12:23 PM
 */



DEFINE('DS', DIRECTORY_SEPARATOR);
DEFINE('ROOT',dirname(dirname(__FILE__)));

define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DATABASE','usermgmt');
define ('DEBUG', true);
define ('BASE_URL','http://localhost:100/TestApiCall/');
//define("BASE_URL","localhost:70/usermanagement/");

$parts = array();
$parts = explode("/", $url);


$controller = isset($parts[0])? $parts[0]:"";
$controller = ucwords($controller);

array_shift($parts);
$action = isset($parts[0])? $parts[0]:"";

array_shift($parts);
$para = $parts;
//var_dump($para);

if(empty($controller)){
    $controller = 'Home';
}

if(empty($action)){
    $action = 'index';
}

function __autoload($class_name) {

    //var_dump($class_name);
    if(file_exists($class_name . '.php')){
        include $class_name . '.php';
    }
    else if(file_exists("$class_name.php")){
        include "$class_name.php";
    }
    //else if(file_exists()){
    //include
    // }
}

$controller = new $controller();
$controller->$action($para);
