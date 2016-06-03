<?php
// @todo code the controller builder CLI
require_once "vendor/autoload.php";
require_once "config.php";
\Helper\ConfigurationManager::init();
\Helper\ServiceContainer::init();
$loader = new \Twig_Loader_Filesystem(APP_CORE_DIR.'builder/templates/');
$twig = new \Twig_Environment($loader, array(
    'cache' => APP_CACHE_DIR,
));
echo $twig->render('controller.php.twig', [
    'controllerName' => 'SomeClass',
    'methods' => [
        'index',
        'list'
    ]
]);
