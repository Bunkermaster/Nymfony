<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/05/16
 * Time: 11:47
 */

namespace Helper;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Doctrine
{
    public static function init()
    {
        $paths = array(APP_ROOT_DIR."Model/Entity/");
        $isDevMode = false;
        $dbParams = array(
            'driver'   => APP_DB_DRIVER,
            'user'     => APP_DB_USER,
            'password' => APP_DB_PASS,
            'dbname'   => APP_DB_NAME,
            'port'   => APP_DB_PORT,
            'host'   => APP_DB_HOST,
        );
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        return  EntityManager::create($dbParams, $config);
    }
}