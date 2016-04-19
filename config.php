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
 * MySQL Host
 */
define('APP_DB_HOST', 'localhost');
/**
 * MySQL Port
 */
define('APP_DB_PORT', '3306');
/**
 * MySQL database name
 */
define('APP_DB_NAME', 'kandt');
/**
 * MySQL user name
 */
define('APP_DB_USER', 'root');
/**
 * MySQL user password
 */
define('APP_DB_PASS', 'root');
/**
 * JSON output query string flag
 */
define('APP_JSON_QUERY_STRING_FLAG', 'json');

try {
    $pdo = new PDO('mysql:host='.APP_DB_HOST.';dbname='.APP_DB_NAME.';port='.APP_DB_PORT, APP_DB_USER, APP_DB_PASS);
} catch (PDOException $p) {
    // @todo: add clean connection error page
    die($p->getMessage());
}
$pdo->query("SET NAMES 'utf8';");
\Helper\Container::register($pdo);
