<?php
namespace Helper;


/**
 * Class Install
 * @package Helper
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class Install
{

    /**
     *
     */
    public static function postInstall()
    {
        $rootDir =  dirname(__DIR__);
        $link = $rootDir."/Public/bootstrap";
        if (!file_exists($link)) {
            symlink($rootDir.'/vendor/twbs/bootstrap/dist', $link);
        } else {
            echo "Boostrap symlink already exists.".PHP_EOL;
        }
    }
}
