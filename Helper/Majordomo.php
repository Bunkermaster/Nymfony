<?php
namespace Helper;

/**
 * Class Majordomo
 * @package Helper
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class Majordomo
{
    public static function config()
    {
        ShellColor::mecho(PHP_EOL, 'white', 'green');
        ShellColor::mecho('[App Configuration]' . PHP_EOL, 'white', 'green');
        $constants = get_defined_constants(true);
        foreach ($constants['user'] as $constantName => $constantValue) {
            ShellColor::mecho($constantName . ' = ' . $constantValue . PHP_EOL, 'white', 'green');
        }
    }
}
