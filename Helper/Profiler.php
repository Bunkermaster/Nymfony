<?php
namespace Helper;

/**
 * Class Profiler
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Helper
 */
class Profiler
{
    private static $timeStart = 0;
    private static $timeStop = 0;
    private static $timeTotal = 0;
    private static $memory = 0;
    private static $route = "n/a";
    private static $sqlTimer = 0;
    private static $outputSize = 0;
    
    public static function startTimer()
    {
        self::$timeStart = microtime(true);
    }
    
    public static function stopTimer()
    {
        self::$timeStop = microtime(true);
        self::$timeTotal = self::$timeStop - self::$timeStart;
    }
    
    public static function addSqlTime($time)
    {
        self::$sqlTimer += $time;
    }
    
    public static function dump()
    {
        return [
            'memory' => self::$memory,
            'time' => self::$timeTotal,
            'route' => self::$route,
            'sqlTime' => self::$sqlTimer,
            'outputSize' => self::$outputSize,
        ];
    }
}
