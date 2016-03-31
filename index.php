<?php
require_once "vendor/autoload.php";
require_once "config.php";

if(isset($_GET['route'])){
    $currRoute = $_GET['route'];
} else {
    $currRoute = APP_DEFAULT_ROUTE;
}
// EN PHP 7
// $currRoute = $_GET['route'] ?? APP_DEFAULT_ROUTE; 

$controller = new \Controller\PageController($pdo);
switch($currRoute){
    case 'about':
        $controller->aboutAction();
        break;
    default:
        $controller->homeAction();
        break;
}
