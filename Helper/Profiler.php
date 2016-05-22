<?php
namespace Helper;

/**
 * Class Profiler
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Helper
 */
class Profiler
{
    /**
     * @var int
     */
    private static $timeStart = 0;
    /**
     * @var int
     */
    private static $timeStop = 0;
    /**
     * @var int
     */
    private static $timeTotal = 0;
    /**
     * @var int
     */
    private static $memory = 0;
    /**
     * @var string
     */
    private static $route = "n/a";
    /**
     * @var int
     */
    private static $sqlTimer = 0;
    /**
     * @var int
     */
    private static $outputSize = 0;

    /**
     * set self::$timeStart to current timestamp
     */
    public static function startTimer()
    {
        self::$timeStart = microtime(true);
    }

    /**
     * set self::$timeStop to current timestamp
     */
    public static function stopTimer()
    {
        self::$timeStop = microtime(true);
        self::$timeTotal = self::$timeStop - self::$timeStart;
    }

    /**
     * adds time to SQL timer
     * @param $time
     */
    public static function addSqlTime($time)
    {
        self::$sqlTimer += $time;
    }

    /**
     * dumps all profiler values as array
     * @return array
     */
    public static function dump() : array
    {
        return [
            'memory' => self::$memory,
            'time' => self::$timeTotal,
            'route' => self::$route,
            'sqlTime' => self::$sqlTimer,
            'outputSize' => self::$outputSize,
        ];
    }

    /**
     * sets memory usage
     * @param $memory
     */
    public static function setMemory($memory)
    {
        self::$memory = $memory;
    }

    /**
     * sets route
     * @param $route
     */
    public static function setRoute($route)
    {
        self::$route = $route;
    }

    /**
     * set output size
     * @param $outputSize
     */
    public static function setOutputSize($outputSize)
    {
        self::$outputSize = $outputSize;
    }
}
