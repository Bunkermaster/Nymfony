<?php
namespace Helper;

use Exception\RouterException;

/**
 * Class Router
 * @package Helper
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class Router
{
    /**
     * @var array static
     */
    private static $routesCollection;
    /**
     * @var array static
     */
    private static $routesIdentifierCollection;
    /**
     * string
     */
    const ROUTE_FILE = 'routes.json';
    /**
     * string
     */
    const ROUTE_ALL_METHODS_PLACEHOLDER = 'ALL';

    /**
     * Initialize the router
     * @throws RouterException
     * @returns void
     */
    public static function init()
    {
        $routeFile = APP_ROOT_DIR.self::ROUTE_FILE;
        // controle de presence du fichier de routes
        if (!file_exists($routeFile)) {
            throw new RouterException(
                'Router file \''.$routeFile.'\' not found',
                100
            );
        }
        $routes = json_decode(file_get_contents($routeFile));
        // is not JSON, exception
        if ($routes === false) {
            throw new RouterException('Router file badly formated', 200);
        }
        // load list of routes
        foreach ($routes as $routeIdentifier => $route) {
            // build full internal route name
            if (isset($route->method)) {
                $internalRouteMethod = $route->method;
            } else {
                $internalRouteMethod = self::ROUTE_ALL_METHODS_PLACEHOLDER;
            }
            self::$routesCollection[$route->name][$internalRouteMethod] = $route;
            self::$routesCollection[$route->name][$internalRouteMethod]->routeIdentifier = $routeIdentifier;
            self::$routesIdentifierCollection[$routeIdentifier] =
                &self::$routesCollection[$route->name][$internalRouteMethod];
        }
    }

    /**
     * @param $name
     * @return object|bool
     */
    public static function getRoute($name)
    {
        /** @var \Helper\Request $request */
        $request = ServiceContainer::getService('Request');
        if (isset(self::$routesCollection[$name][$request->HTTP['method']])) {
            
            return self::$routesCollection[$name][$request->HTTP['method']];
        } elseif (isset(self::$routesCollection[$name][self::ROUTE_ALL_METHODS_PLACEHOLDER])) {
            
            return self::$routesCollection[$name][self::ROUTE_ALL_METHODS_PLACEHOLDER];
        } else {
            
            return false;
        }
    }

    /**
     * dump all routes for debug
     */
    public static function dump()
    {
        if (count(self::$routesCollection)==0) {

            return "No routes specified";
        } else {
            $output = [];
            $i = 0;
            foreach (self::$routesIdentifierCollection as $identifier => $route) {
                $output[$i]['identifier'] = $identifier;
                $output[$i]['name'] = $route->name;
                $output[$i]['controller'] = $route->controller ?? 'N/A';
                $output[$i]['action'] = $route->action ?? 'N/A';
                $output[$i]['method'] = $route->method ?? 'ALL';
                $i++;
            }

            return $output;
        }
    }
}
