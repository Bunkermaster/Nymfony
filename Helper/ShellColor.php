<?php
namespace Helper;

/**
 * Class ShellColor
 * Thanks you JR from www.if-not-true-then-false.com
 * He made a nice little article on coloring and I used his color array
 * @package Helper
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
/**
 * Class ShellColor
 * @package Helper
 */
class ShellColor
{
    /**
     * @var array list foreground colors
     */
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
    /**
     * @var array list background colors
     */
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

    /**
     * @var string default foreground color
     */
    private static $defaultFGColor = 'white';
    /**
     * @var string default background color
     */
    private static $defaultBGColor = 'black';

    /**
     * @param $string
     * @param null $FGColor
     * @param null $BGColor
     */
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

    /**
     * @param $output
     * @param null $FGColor
     * @param null $BGColor
     */
    public static function commandOutput($output, $FGColor = null, $BGColor = null)
    {
        $outputArray = explode(PHP_EOL, $output);
        $formatedOutput = PHP_EOL . PHP_EOL;
        for ($i = 0; $i < count($outputArray); $i++) {
            if (mb_strlen($outputArray[$i]) > 0) {
                if ($i == 0) {
                    $formatedOutput .= "  ";
                } else {
                    $formatedOutput .= "    ";
                }
                $formatedOutput .= $outputArray[$i] . PHP_EOL;
            }
        }
        $formatedOutput .= PHP_EOL;
        self::mecho($formatedOutput, $FGColor, $BGColor);
    }

}
