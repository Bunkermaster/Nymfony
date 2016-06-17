<?php
use Helper\{ServiceContainer, ConfigurationManager};

session_start();
require_once "config.php";
// check for PHP version 7 or above
if (version_compare(PHP_VERSION, '7.0.0') < 0) {
    require_once APP_VIEW_DIR.'scafolding/php-version-error.php';
    die();
}
ConfigurationManager::init();
ServiceContainer::init();
require_once "doctrineBootstrap.php";
