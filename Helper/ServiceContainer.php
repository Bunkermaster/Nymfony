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
 * Class ServiceContainer
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Helper
 */
class ServiceContainer
{
    /**
     * @var array
     */
    private static $serviceCollection = [];
    
    const SERVICE_FILE = 'services.json';

    /**
     * Service Container retrieval method.
     * Can be used to add a new service.
     * @param string $service
     * @param array $params optional service __construct parameters
     * @return mixed
     * @throws ContainerException
     */
    public static function getService($service, $params = [])
    {
        if (!isset(self::$serviceCollection[$service])) {
            if (class_exists($service)) {
                $classParams['class'] = $service;
                $classParams['param'] = $params;
                $refClass = new \ReflectionClass($service);
                // get class name
                $name = $refClass->getShortName();
                if (isset(self::$serviceCollection[$name])) {
                    $name = $refClass->getName();
                } elseif (isset(self::$serviceCollection[$name])) {
                    throw new ContainerException('Service name already taken ('.$service.')');
                }
                self::$serviceCollection[$name] = self::instanciate($classParams);
            } else {
                throw new ContainerException($service.' not found');
            }
        }
        return self::$serviceCollection[$service];
    }
    
    public static function init()
    {
        if (!file_exists(APP_ROOT_DIR.self::SERVICE_FILE)) {
            // @todo change message...
            throw new ContainerException('OH MY FUCKING GOD');
        }
        if (!$services = json_decode(file_get_contents(APP_ROOT_DIR.self::SERVICE_FILE), true)) {
            // @todo change message asshat...
            throw new ContainerException('WHAT THE HELL!!!! FOAD');
        }
        foreach ($services as $name => $serviceArray) {
            if (!isset($serviceArray['class'])) {
                continue;
            }
            self::$serviceCollection[$name] = self::instanciate($serviceArray);
        }
    }

    /**
     * Instanciate an object based on parameters stored in array
     * @param array $serviceArray
     * @return object
     */
    private static function instanciate(array $serviceArray)
    {
        $className = $serviceArray['class'];
        $constructor = new \ReflectionMethod($serviceArray['class'], '__construct');
        $paramCount = 0;
        $paramValues = [];
        foreach ($constructor->getParameters() as $paramSolo) {
            $reflectParam = new \ReflectionParameter([$serviceArray['class'], '__construct'], $paramSolo->name);
            if (isset($serviceArray['param'][$paramCount])) {
                $paramValues[$paramCount] = $serviceArray['param'][$paramCount];
            } elseif (!$reflectParam->isOptional() && $reflectParam->isDefaultValueAvailable()) {
                $paramValues[$paramCount] = $reflectParam->getDefaultValue();
            }
            $paramCount++;
        }
        $class = new \ReflectionClass($className);
        $instance = $class->newInstanceArgs($paramValues);
        return $instance;
    }

    /**
     * @return array
     */
    public static function getServiceCollection()
    {

        return self::$serviceCollection;
    }

}