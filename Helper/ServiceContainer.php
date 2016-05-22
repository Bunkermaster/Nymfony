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

    /**
     * Configuration file path
     */
    const SERVICE_FILE = APP_ROOT_DIR.'services.json';

    /**
     * Service Container retrieval method.
     * Can be used to add a new service.
     * @param string|object $service
     * @param array $params optional service __construct parameters
     * @return mixed
     * @throws ContainerException
     */
    public static function getService($service, $params = [])
    {
        if (!is_object($service) && !isset(self::$serviceCollection[$service])) {
            if (class_exists($service)) {
                $classParams['class'] = $service;
                $classParams['param'] = $params;
                $refClass = new \ReflectionClass($service);
                // get class name
                $name = $refClass->getShortName();
                if (isset(self::$serviceCollection[$name])) {
                    throw new ContainerException('Service name already taken ('.$service.')');
                }
                self::$serviceCollection[$name] = self::instanciate($classParams);
            } else {
                throw new ContainerException(
                    $service.' not found (invoked from'.debug_backtrace()[0]['file'].
                    ' line '.debug_backtrace()[0]['line'].')'
                );
            }
        } elseif (is_object($service)) {
            $servicereflection = new \ReflectionClass(get_class($service));
            $name = $servicereflection->getShortName();
            if (isset(self::$serviceCollection[$name])) {
                throw new ContainerException('Service name already taken ('.$name.')');
            }
            self::$serviceCollection[$name] = $service;
            $service = $name;
        }
        return self::$serviceCollection[$service];
    }

    /**
     * init initializes the ServiceContainer based on the /services.json file
     * @throws ContainerException
     */
    public static function init()
    {
        if (!file_exists(self::SERVICE_FILE)) {
            throw new ContainerException('ServiceContainer configuration file \'services.json\' doesn\'t exist');
        }
        if (!$services = json_decode(file_get_contents(self::SERVICE_FILE), true)) {
            throw new ContainerException('ServiceContainer configuration file \'services.json\' badly formated');
        }
        foreach ($services as $name => $serviceArray) {
            if (!isset($serviceArray['class'])) {
                continue;
            }
            $devMode = $serviceArray['devmode'] ?? false;
            // instanciate only "devmode" => true services when in APP_DEV_MODE true
            if ((APP_DEV_MODE === false && $devMode === false) || APP_DEV_MODE === true ) {
                self::$serviceCollection[$name] = self::instanciate($serviceArray);
            }
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
            } else {
                // @todo handle the case where no param was given for a parma missing default value
            }
            $paramCount++;
        }
        $class = new \ReflectionClass($className);
        $instance = $class->newInstanceArgs($paramValues);
        return $instance;
    }

    /**
     * getServiceCollection allows for Container dump for debugging
     * @return array
     */
    public static function getServiceCollection()
    {

        return self::$serviceCollection;
    }

}