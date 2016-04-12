<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/04/16
 * Time: 13:56
 */

namespace Controller;

use Exception\FrontControllerException;
use Helper\Container;
use Helper\Request;
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
     * @throws FrontControllerException
     */
    public function __construct()
    {
        // init request object
        $request = new Request();
        Container::register($request);
        // init router
        if(isset($_GET['route'])){
            $currRoute = $_GET['route'];
        } elseif(isset($_POST['route'])) {
            $currRoute = $_POST['route'];
        } else {
            $currRoute = APP_DEFAULT_ROUTE;
        }
        // get router
        $router = new Router();
        // get current route's info
        if(!($route = $router->getRoute($currRoute))){
            throw new FrontControllerException('Route not found');
        }
        $controllerName = __NAMESPACE__.'\\'.$route->controller."Controller";
        $methodName = $route->action."Action";
        // controle de l'existence de la route demandee
        if(!class_exists($controllerName)){
            throw new \Exception('wtf');
        }
        $controller = new $controllerName();
        $controller->$methodName();
    }
}