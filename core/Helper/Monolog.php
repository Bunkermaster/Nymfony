<?php
namespace Helper;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Monolog
{
    public static function init()
    {
        $logger = new Logger('App');
        $logger->pushHandler(new StreamHandler(APP_LOG_FILE, Logger::INFO));
        return $logger;
    }
}
