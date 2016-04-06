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
        // exception si le fichier n'est pas un JSON propre
        if($routes === false){
            throw new RouterException('Router file badly formated',200);
        }
        // chargement de la liste des routes
        foreach($routes as $route){
            $this->routesCollection[$route->name] = $route;
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function getRoute($name)
    {
        if(isset($this->routesCollection[$name])){
            return $this->routesCollection[$name];
        } else {
            return false;
        }
    }
}
