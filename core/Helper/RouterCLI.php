<?php
namespace Helper;

/**
 * Class RouterCLI
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package core\Helper
 */
class RouterCLI
{
    /**
     * Outputs router debug information
     * @return void
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
}
