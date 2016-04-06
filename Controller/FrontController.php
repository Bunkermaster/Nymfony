<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/04/16
 * Time: 13:56
 */

namespace Controller;


use Helper\Router;

/**
 * Class FrontController
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Controller
 */
class FrontController
{
    /**
     * FrontController constructor.
     */
    public function __construct()
    {
        if(isset($_GET['route'])){
            $currRoute = $_GET['route'];
        } else {
            $currRoute = APP_DEFAULT_ROUTE;
        }
        // EN PHP 7
        // $currRoute = $_GET['route'] ?? APP_DEFAULT_ROUTE;
        // get router
        $router = new Router();
        // get current route's info
        $route = $router->getRoute($currRoute);
        $controllerName = __NAMESPACE__.'\\'.$route->controller."Controller";
        $methodName = $route->method."Action";
        // controle de l'existence de la route demandee
        if(!class_exists($controllerName)){
            throw new \Exception('wtf');
        }
        $controller = new $controllerName();
        switch($currRoute){
            case 'about':
                $controller->aboutAction();
                break;
            default:
                $controller->homeAction();
                break;
        }

    }
}