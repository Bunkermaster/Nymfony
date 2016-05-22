<?php
/**
 *
 */
\Helper\Profiler::startTimer();
require_once "../vendor/autoload.php";
require_once "../config.php";
require_once "../init.php";
$app = new \Controller\FrontController();
\Helper\Profiler::stopTimer();
var_dump(\Helper\Profiler::dump());
