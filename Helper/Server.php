<?php
namespace Helper;

/**
 * Class Server
 * @package Helper
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class Server
{
    /**
     * Runs server
     * @fixme fix PHP version issues
     */
    public static function run()
    {
        `php -S localhost:8000 -t Public/`;
    }
}
