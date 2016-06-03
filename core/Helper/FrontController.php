<?php
namespace Helper;

use Exception\FrontControllerException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Helper\ConfigurationManager;

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
        parent::__construct();
        // get logger 
        $logger = ServiceContainer::getService('Logger');
        $logger->pushHandler(new StreamHandler(APP_LOG_FILE, Logger::INFO));
        if (ConfigurationManager::getConfig('APP_DEV_MODE') === true) {
            $devLogger = ServiceContainer::getService('DevLogger');
            $devLogger->pushHandler(new StreamHandler(APP_DEV_LOG_FILE, Logger::INFO));
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
            $currRoute = ConfigurationManager::getConfig('APP_DEFAULT_ROUTE');
        }
        // init router
        Router::init();
        if (ConfigurationManager::getConfig('APP_DEV_MODE') === true) {
            Profiler::setRoute($currRoute);
        }
        // get current route's info
        if (!($route = Router::getRoute($currRoute))) {
            // if the route is not found, 404 error
            $this->twigRender('404.html.twig', [], 404);
            $response->output();
        } else {
            if (ConfigurationManager::getConfig('APP_DEV_MODE') === true) {
                Profiler::setRoute(var_export($route, true));
            }
            $controllerName = 'Controller\\'.$route->controller."Controller";
            $methodName = $route->action."Action";
            // check for requested route existance
            if (!class_exists($controllerName)) {
                $logger->addCritical(
                    'Controller class does not exist',
                    ['Missing class' => $controllerName]
                );
                throw new FrontControllerException('Controller class does not exist');
            }
            $logger->addInfo(
                'App access',
                ['Requested route' => $route->routeIdentifier, 'Request IP' => $request->IP]
            );
            $controller = new $controllerName();
            if (!method_exists($controller, $methodName)) {
                $logger->addCritical(
                    'Controller action method does not exist',
                    ['Missing action method' => $controllerName."::".$methodName]
                );
                throw new FrontControllerException(
                    'Controller action method does not exist'
                );
            }
            if (!isset($request->GET[APP_JSON_QUERY_STRING_FLAG])) {
                $this->render('scafolding/header.php');
            }
            try{
                $controller->$methodName();
            } catch( \Exception $e){
                header('Content-Type: text/text; charset=UTF-8');
                echo $e->getMessage().PHP_EOL;
                echo "Code::".$e->getCode().PHP_EOL;
                echo $e->getTraceAsString() .PHP_EOL;
                die();
            }
            if (!isset($request->GET[APP_JSON_QUERY_STRING_FLAG])) {
                $this->render('scafolding/footer.php');
            }
            if (ConfigurationManager::getConfig('APP_DEV_MODE') === true) {
                Profiler::setMemory(memory_get_usage());
            }
            $response->output();
        }
    }
}
