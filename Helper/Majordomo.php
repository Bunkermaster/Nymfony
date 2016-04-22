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
     *
     */
    public static function config()
    {
        $configOutput = '[App Configuration]' . PHP_EOL;
        $constants = get_defined_constants(true);
        foreach ($constants['user'] as $constantName => $constantValue) {
            $configOutput .= $constantName . ' = ' . $constantValue . PHP_EOL;
        }
        ShellColor::commandOutput($configOutput.PHP_EOL, 'white', 'green');
    }

    /**
     *
     */
    public static function router()
    {
        $routerOutput = '[Router]' . PHP_EOL;
        Router::init();
        $routes = Router::dump();
        $routerOutput .= TableBuilder::init(
            $routes,
            ['identifier', 'name', 'controller', 'action', 'method']
        );
        ShellColor::commandOutput($routerOutput.PHP_EOL, 'white', 'green');
    }
}
