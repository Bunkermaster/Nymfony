<?php
/**
 *
 */
require_once "../vendor/autoload.php";
require_once "../config.php";
require_once "../init.php";
if (\Helper\ConfigurationManager::getConfig('APP_DEV_MODE') === true) {
    \Helper\Profiler::startTimer();
}
$app = new \Helper\FrontController();
if (\Helper\ConfigurationManager::getConfig('APP_DEV_MODE') === true) {
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
    if (isset($request->GET[APP_JSON_QUERY_STRING_FLAG])) {
        \Helper\Profiler::dump();
    }
}