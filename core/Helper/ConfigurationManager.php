<?php
namespace Helper;

/**
 * Class ConfigurationManager
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Helper
 */
class ConfigurationManager
{
    /**
     * @var array
     */
    private static $configurationCollection = [];
    /**
     *
     */
    const CONFIGURATION_FILE = APP_CONFIG_DIR.'config.json';

    /**
     * @param string $key
     * @param bool|string|array|float|int|null $value
     * @return bool|string|array|float|int configuration value
     * @throws \Exception
     */
    public static function getConfig(string $key, $value = null)
    {
        if($value === null){
            if(!isset(self::$configurationCollection[$key])){
                $backtrace = debug_backtrace();
                throw new \Exception(
                    "Configuration key '$key' not found. ".
                    $backtrace[0]['file'] . ' line ' . $backtrace[0]['line']
                );
            }
            return self::$configurationCollection[$key];
        } else {
            if(isset(self::$configurationCollection[$key])){
                throw new \Exception("Configuration key '$key' already exists.");
            }
            self::$configurationCollection[$key] = $value;
        }

        return $value;
    }

    /**
     * @throws \Exception\JsonException
     */
    public static function init()
    {
        $configuration = JsonParser::getJson(self::CONFIGURATION_FILE, 'Configuration file \'%s\' not found');
        foreach ($configuration as $name => $configurationValue) {
            self::$configurationCollection[$name] = $configurationValue;
        }
    }
    
    /**
     * getServiceCollection allows for Container dump for debugging
     * @return array
     */
    public static function dump()
    {

        return self::$configurationCollection;
    }
}