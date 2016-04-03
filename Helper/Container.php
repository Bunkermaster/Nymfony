<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/04/16
 * Time: 15:33
 */

namespace Helper;

use Exception\ContainerException;

/**
 * service container
 * Class Container
 * @package Helper
 */
class Container
{
    /**
     * @var array
     */
    private static $serviceCollection = [];

    /**
     * @param $serviceName
     * @return mixed
     * @throws ContainerException
     */
    public static function getService($serviceName)
    {
        if(!isset(Container::$serviceCollection[$serviceName])){
            throw new ContainerException();
        }
        return self::$serviceCollection[$serviceName];
    }

    /**
     * @param object $serviceObject
     * @param string $serviceName
     */
    public static function register($serviceObject, $serviceName = null)
    {
        // service has to be an object, exception if nomt
        if(!is_object($serviceObject)){
            throw new \BadMethodCallException("Container Parameter was not an object");
        }
        // store service in Container's static collection
        // regiter service
        if(is_null($serviceName)){
            self::$serviceCollection[get_class($serviceObject)] = $serviceObject;
        } else {
            self::$serviceCollection[$serviceName] = $serviceObject;
        }
    }

    /**
     * @return array
     */
    public static function getServiceCollection()
    {

        return self::$serviceCollection;
    }

}