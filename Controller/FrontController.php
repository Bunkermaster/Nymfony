<?php

namespace Controller;

use Exception\FrontControllerException;
use Helper\Container;
use Helper\Request;
use Helper\Response;
use Helper\Router;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class FrontController
 * @package Controller
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class FrontController extends Controller
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
        // init Request object
        $request = new Request();
        Container::register($request);
        // init Response object
        $response = new Response();
        Container::register($response);
//        var_dump(Container::getServiceCollection());die();
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
        // init router
        Router::init();
        // get current route's info
        if (!($route = Router::getRoute($currRoute))) {
            // if the route is not found, 404 error
            if (!isset($request->GET[APP_JSON_QUERY_STRING_FLAG])) {
                $this->render('scafolding/header.php');
            }
            $this->render('404.php', [], 404)->output();
            if (!isset($request->GET[APP_JSON_QUERY_STRING_FLAG])) {
                $this->render('scafolding/footer.php');
            }
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
            ['Requested route'=>$route->routeIdentifier, 'Request IP' => $request->IP]
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
        if (!isset($request->GET[APP_JSON_QUERY_STRING_FLAG])) {
            $this->render('scafolding/header.php');
        }
        $controller->$methodName();
        if (!isset($request->GET[APP_JSON_QUERY_STRING_FLAG])) {
            $this->render('scafolding/footer.php');
        }
        $response->output();
    }
}
