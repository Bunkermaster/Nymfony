<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Helper\{ServiceContainer, ConfigurationManager};

require_once "config.php";

// check for PHP version 7 or above
if (version_compare(PHP_VERSION, '7.0.0') < 0) {
    require_once APP_VIEW_DIR.'scafolding/php-version-error.php';
    die();
}
ConfigurationManager::init();
ServiceContainer::init();
// replace with file to your own project bootstrap
require_once 'doctrineBootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = ServiceContainer::getService("EntityManager");

return ConsoleRunner::createHelperSet($entityManager);
