<?php
namespace Controller;

use Exception\FrontControllerException;
use Helper\Controller;
use Helper\Router;
use Helper\ServiceContainer;
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
        // get logger 
        $logger = ServiceContainer::getService('Logger');
        $logger->pushHandler(new StreamHandler(APP_LOG_FILE, Logger::INFO));
        if (APP_DEV_MODE === true) {
            $devLogger = ServiceContainer::getService('DevLogger');
            $devLogger->pushHandler(new StreamHandler(APP_LOG_FILE, Logger::INFO));
        }
        // init Request object
        $request = ServiceContainer::getService('Request');
        // init Response object
        $response = ServiceContainer::getService('Response');
        // init router
        if (isset($_GET['route'])) {
            $currRoute = $_GET['route'];
        } elseif (isset($_POST['route'])) {
            $currRoute = $_POST['route'];
        } else {
            $currRoute = APP_DEFAULT_ROUTE;
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
