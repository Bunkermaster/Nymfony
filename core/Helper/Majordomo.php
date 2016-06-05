<?php
namespace Helper;


/**
 * Class Majordomo
 * @package Helper
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class Majordomo
{
    /**
     * Outputs current configuration
     */
    public static function config()
    {
        $configOutput = '[App Configuration]' . PHP_EOL;
        ConfigurationManager::init();
        $constants = array_merge(get_defined_constants(true)['user'], ConfigurationManager::dump());
        foreach ($constants as $constantName => $constantValue) {
            $configOutput .= $constantName . ' = ' . var_export($constantValue, true) . PHP_EOL;
        }
        CLIShellColor::commandOutput($configOutput.PHP_EOL, 'white', 'green');
    }

    /**
     * Outputs router debug information
     */
    public static function router()
    {
        $routerOutput = '[Router]' . PHP_EOL;
        Router::init();
        $routes = Router::dump();
        $routerOutput .= CLITableBuilder::init(
            $routes,
            ['identifier', 'name', 'controller', 'action', 'method'],
            false,
            10
        );
        CLIShellColor::commandOutput($routerOutput.PHP_EOL, 'white', 'green');
    }

    /**
     * Outputs container debug information
     */
    public static function container()
    {
        $containerOutput = '[ServiceContainer]' . PHP_EOL;
        ServiceContainer::init();
        $services = ServiceContainer::getServiceCollection();
        $serviceDebug = [];
        foreach ($services as $name => $service) {
            $serviceDebug[] = [
                'name' => $name,
                'class' => get_class($service),
            ];
        }
        $containerOutput .= CLITableBuilder::init(
            $serviceDebug,
            ['Name', 'Class'],
            false,
            10
        );
        CLIShellColor::commandOutput($containerOutput.PHP_EOL, 'white', 'green');
    }

    public static function clearTwigCache()
    {
        CLIShellColor::commandOutput("Clearing cache", 'green', 'black');
        $path = APP_CACHE_DIR;
        $rmDir = function($file, $path) use (&$rmDir)
        {
            if(substr($file, 0, 1) !== '.'){
                if(is_dir($path.$file)){
                    if(($dirContent = scandir($path.$file)) !== false){
                        if(count($dirContent) > 2){
                            foreach($dirContent as $oneDir){
                                $rmDir($oneDir, $path.$file.'/');
                            }
                        } else {
                            rmdir($file);
                        }
                    }
                    rmdir($path.$file);
                } elseif(is_file($path.$file)) {
                    unlink($path.$file);
                }
            }
        };
        foreach( scandir($path) as $oneFile){
            $rmDir($oneFile, $path);
        }
        CLIShellColor::commandOutput("Cache cleared", 'green', 'black');
    }

    /**
     * Builds the commands array for the bin/console based on the commands.json file
     * @param $configurationFile
     * @return array
     * @throws \Exception\JsonException
     */
    public static function loadConfig($configurationFile) : array
    {
        $commandsArray = JsonParser::getJson($configurationFile, "Command configuratio file not found");
        $commands = [];
        foreach($commandsArray as $catName => $category){
            foreach($category as $commandName => $command){
                $commands[$catName][$command['name']]['method'] = $command['method'];
                $commands[$catName][$command['name']]['man'] = $command['man'];
            }
        }
        return $commands;
    }
}
