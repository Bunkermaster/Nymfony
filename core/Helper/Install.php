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
     * Create symlink to JQUery and Bootstrap vendor
     */
    public static function postInstall()
    {
        $rootDir =  dirname(__DIR__);
        $bootstrapLink = $rootDir."/Public/bootstrap";
        if (!file_exists($bootstrapLink)) {
            symlink($rootDir.'/vendor/twbs/bootstrap/dist', $bootstrapLink);
        } else {
            echo "Boostrap symlink already exists.".PHP_EOL;
        }
        $jqueryLink = $rootDir."/Public/jquery";
        if (!file_exists($jqueryLink)) {
            symlink($rootDir.'/vendor/components/jquery/', $jqueryLink);
        } else {
            echo "JQuery symlink already exists.".PHP_EOL;
        }
    }
}
