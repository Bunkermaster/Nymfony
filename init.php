<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Helper\ServiceContainer;
use \Helper\ConfigurationManager;

session_start();
// check for PHP version 7 or above
if (version_compare(PHP_VERSION, '7.0.0') < 0) {
    require_once APP_VIEW_DIR.'scafolding/php-version-error.php';
    die();
}
ConfigurationManager::init();
ServiceContainer::init();
$pdo = ServiceContainer::getService('PDO');
$pdo->query("SET NAMES 'utf8';");
$config = Setup::createAnnotationMetadataConfiguration(
    array(APP_ROOT_DIR."Model/Entity/"),
    ConfigurationManager::getConfig('APP_DEV_MODE')
);
// database configuration parameters
$conn = array(
    'driver'   => ConfigurationManager::getConfig('APP_DB_DRIVER'),
    'user'     => ConfigurationManager::getConfig('APP_DB_USER'),
    'port'     => ConfigurationManager::getConfig('APP_DB_PASS'),
    'password' => ConfigurationManager::getConfig('APP_DB_PASS'),
    'dbname'   => ConfigurationManager::getConfig('APP_DB_NAME'),
);
$entityManager = EntityManager::create($conn, $config);
ServiceContainer::getService($entityManager);
