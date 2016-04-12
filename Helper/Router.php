<?php
namespace Helper;

use Exception\RouterException;

/**
 * Class Router
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Helper
 */
class Router
{
    /**
     * @var array
     */
    private $routesCollection;
    /**
     * string
     */
    const ROUTE_FILE = 'routes.json';
    /**
     * string
     */
    const ROUTE_ALL_METHODS_PLACEHOLDER = 'ALL';
    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * @throws RouterException
     */
    private function init()
    {
        $routeFile = APP_ROOT_DIR.self::ROUTE_FILE;
        // controle de presence du fichier de routes
        if(!file_exists($routeFile)){
            throw new RouterException('Router file \''.$routeFile.'\' not found',100);
        }
        $routes = json_decode(file_get_contents($routeFile));
        // is not JSON, exception
        if($routes === false){
            throw new RouterException('Router file badly formated',200);
        }
        // load list of routes
        foreach($routes as $route){
            // build full internal route name
            if(isset($route->method)){
                $internalRouteMethod = $route->method;
            } else {
                $internalRouteMethod = self::ROUTE_ALL_METHODS_PLACEHOLDER;
            }
            $this->routesCollection[$route->name][$internalRouteMethod] = $route;
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function getRoute($name)
    {
        /** @var \Helper\Request $request */
        $request = Container::getService('HelperRequest');
        if(isset($this->routesCollection[$name])){
            return $this->routesCollection[$name][$request->HTTP['method']];
        } elseif(isset($this->routesCollection[$name][self::ROUTE_ALL_METHODS_PLACEHOLDER])){
            return $this->routesCollection[$name][self::ROUTE_ALL_METHODS_PLACEHOLDER];
        } else {
            return false;
        }
    }

    /**
     *
     */
    public function dump()
    {
        if(count($this->routesCollection)==0){

            return "No routes specified";
        } else {
            
            return var_export($this->routesCollection , true);
        }
    }
}
