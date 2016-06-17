<?php
use Doctrine\ORM\{Tools\Setup, EntityManager};
use Helper\{ServiceContainer, ConfigurationManager};
use Doctrine\Common\Annotations\AnnotationReader;

// Create a simple "default" Doctrine ORM configuration for XML Mapping
$path = [APP_ROOT_DIR."Model/Entity"];
// database configuration parameters
$conn = array(
    'driver'   => ConfigurationManager::getConfig('APP_DB_DRIVER'),
    'user'     => ConfigurationManager::getConfig('APP_DB_USER'),
    'port'     => ConfigurationManager::getConfig('APP_DB_PASS'),
    'password' => ConfigurationManager::getConfig('APP_DB_PASS'),
    'dbname'   => ConfigurationManager::getConfig('APP_DB_NAME'),
);

$cache = new \Doctrine\Common\Cache\ArrayCache();

$reader = new AnnotationReader();
$driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($reader, $path);

$config = Setup::createAnnotationMetadataConfiguration($path, ConfigurationManager::getConfig('APP_DEV_MODE'));
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);
$config->setMetadataDriverImpl($driver);

// create entity manager
$entityManager = ServiceContainer::getService(EntityManager::create($conn, $config));
