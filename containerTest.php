<?php
/**
 *
 */
require_once "vendor/autoload.php";
require_once "config.php";
\Helper\ConfigurationManager::init();
\Helper\ServiceContainer::init();
//var_dump(\Helper\ServiceContainer::getServiceCollection());
//\Helper\ServiceContainer::getService('\DateTime', ['2014-12-12']);
//var_dump(\Helper\ServiceContainer::getServiceCollection());
\Helper\ServiceContainer::getService(new \DateTime('2014-12-12'));
dump(\Helper\ServiceContainer::getServiceCollection());
