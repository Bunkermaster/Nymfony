<?php
/**
 * Root directory
 */
define('APP_ROOT_DIR', __DIR__."/");
/**
 * View directory
 */
define('APP_VIEW_DIR', APP_ROOT_DIR.'View/');
/**
 * Logs directory
 */
define('APP_LOG_DIR', APP_ROOT_DIR.'logs/');
/**
 * Application log file path
 */
define('APP_LOG_FILE', APP_LOG_DIR.'app.log');
/**
 * default route
 */
define('APP_DEFAULT_ROUTE', 'home');
/**
 * Database Host
 */
define('APP_DB_HOST', 'localhost');
/**
 * Database Port
 */
define('APP_DB_PORT', '3306');
/**
 * Database database name
 */
define('APP_DB_NAME', 'kandt');
/**
 * Database user name
 */
define('APP_DB_USER', 'root');
/**
 * Database user password
 */
define('APP_DB_PASS', 'root');
/**
 * Database driver
 */
define('APP_DB_DRIVER', 'pdo_mysql');
/**
 * JSON output query string flag
 */
define('APP_JSON_QUERY_STRING_FLAG', 'json');

// check for PHP version 7 or above
if (version_compare(PHP_VERSION, '7.0.0') < 0) {
    require_once APP_VIEW_DIR.'scafolding/php-version-error.php';
    die();
}
