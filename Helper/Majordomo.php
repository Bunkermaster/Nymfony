<?php
namespace Helper;

/**
 * Class Majordomo
 * @package Helper
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class Majordomo
{
    public static $FGColors = [
        'black' => '0;30',
        'dark_gray' => '1;30',
        'blue' => '0;34',
        'light_blue' => '1;34',
        'green' => '0;32',
        'light_green' => '1;32',
        'cyan' => '0;36',
        'light_cyan' => '1;36',
        'red' => '0;31',
        'light_red' => '1;31',
        'purple' => '0;35',
        'light_purple' => '1;35',
        'brown' => '0;33',
        'yellow' => '1;33',
        'light_gray' => '0;37',
        'white' => '1;37'
    ];
    private static $BGColors = [
        'black' => '40',
        'red' => '41',
        'green' => '42',
        'yellow' => '43',
        'blue' => '44',
        'magenta' => '45',
        'cyan' => '46',
        'light_gray' => '47'
    ];

    private static $defaultFGColor = 'white';
    private static $defaultBGColor = 'black';

    public static function mecho($string, $FGColor = null, $BGColor = null)
    {
        $output = '';
        $coloredOutput = false;
        if (isset(self::$FGColors[$FGColor])) {
            $output .= "\033[".self::$FGColors[$FGColor]."m";
            $coloredOutput = true;
        }
        if (isset(self::$BGColors[$BGColor])) {
            $output .= "\033[".self::$BGColors[$BGColor]."m";
            $coloredOutput = true;
        }
        $output .= $string;
        if ($coloredOutput != false) {
            $output .= "\033[0m";
        }
        echo $output;
    }
    public static function config()
    {
        $constants = get_defined_constants(true);
        foreach ($constants['user'] as $constantName => $constantValue) {
            self::mecho($constantName . ' = ' . $constantValue . PHP_EOL, 'white', 'red');
        }
    }
}
