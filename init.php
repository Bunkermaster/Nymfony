<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Helper\ServiceContainer;

// check for PHP version 7 or above
if (version_compare(PHP_VERSION, '7.0.0') < 0) {
    require_once APP_VIEW_DIR.'scafolding/php-version-error.php';
    die();
}
ServiceContainer::init();
$pdo = \Helper\ServiceContainer::getService('PDO');
$pdo->query("SET NAMES 'utf8';");

$config = Setup::createAnnotationMetadataConfiguration(array(APP_ROOT_DIR."Model/Entity/"), APP_DEV_MODE);
// database configuration parameters
$conn = array(
    'driver'   => APP_DB_DRIVER,
    'user'     => APP_DB_USER,
    'port'     => APP_DB_PASS,
    'password' => APP_DB_PASS,
    'dbname'   => APP_DB_NAME,
);

$entityManager = EntityManager::create($conn, $config);
ServiceContainer::getService($entityManager);
