<?php
/**
 *
 */
require_once "../vendor/autoload.php";
require_once "../config.php";
if (APP_DEV_MODE === true) {
    \Helper\Profiler::startTimer();
}
require_once "../init.php";
$app = new \Controller\FrontController();
if (APP_DEV_MODE === true) {
    \Helper\Profiler::stopTimer();
    $devLogger = \Helper\ServiceContainer::getService('DevLogger');
    /** @var \Helper\Monolog $devLogger */
    $devLogger->addCritical(
        'Profiler info',
        [
            'session' => session_id(),
            'Dump' => var_export(\Helper\Profiler::dump(), true)
        ]
    );
    var_dump(\Helper\Profiler::dump());
}