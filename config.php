<?php
define('APP_ROOT_DIR',__DIR__);
define('APP_VIEW_DIR',APP_ROOT_DIR.'/View/');
define('APP_DEFAULT_ROUTE','home');

try{
    $pdo = new PDO('mysql:host=localhost;dbname=kandt','root','root');
} catch(PDOException $p){
    die($p->getMessage());
}
