<?php

namespace Controller;

use Exception\FrontControllerException;
use Helper\Container;
use Helper\Request;
use Helper\Router;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class FrontController
 * @package Controller
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class FrontController
{
    /**
     * FrontController constructor.
     * @throws FrontControllerException
     */
    public function __construct()
    {
        // init monolog object
        $logger = new Logger('App');
        $logger->pushHandler(new StreamHandler(APP_LOG_FILE, Logger::INFO));
        Container::register($logger, 'logger');
        // init request object
        $request = new Request();
        Container::register($request);
        // init router
        if (isset($_GET['route'])) {
            $currRoute = $_GET['route'];
            $reqRoute = $_GET['route'];
        } elseif (isset($_POST['route'])) {
            $currRoute = $_POST['route'];
            $reqRoute = $_POST['route'];
        } else {
            $currRoute = APP_DEFAULT_ROUTE;
            $reqRoute = 'None';
        }
        // get router
        $router = new Router();
        // get current route's info
        if (!($route = $router->getRoute($currRoute))) {
            $logger->addCritical('Route not found', ['Requested route'=>$reqRoute]);
            throw new FrontControllerException('Route not found');
        }
        $controllerName = __NAMESPACE__.'\\'.$route->controller."Controller";
        $methodName = $route->action."Action";
        // controle de l'existence de la route demandee
        if (!class_exists($controllerName)) {
            $logger->addCritical(
                'Controller class does not exist',
                ['Missing class'=>$controllerName]
            );
            throw new FrontControllerException('Controller class does not exist');
        }
        $logger->addInfo(
            'App access',
            ['Requested route'=>$reqRoute, 'Request IP' => $request->IP]
        );
        $controller = new $controllerName();
        if (!method_exists($controller, $methodName)) {
            $logger->addCritical(
                'Controller action method does not exist',
                ['Missing action method'=>$controllerName."::".$methodName]
            );
            throw new FrontControllerException(
                'Controller action method does not exist'
            );
        }
        echo $controller->$methodName();
    }
}