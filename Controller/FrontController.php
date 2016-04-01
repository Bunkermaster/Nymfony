<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/04/16
 * Time: 13:56
 */

namespace Controller;


class FrontController
{
    public function __construct()
    {
        if(isset($_GET['route'])){
            $currRoute = $_GET['route'];
        } else {
            $currRoute = APP_DEFAULT_ROUTE;
        }
        // EN PHP 7
        // $currRoute = $_GET['route'] ?? APP_DEFAULT_ROUTE;
        $controller = new PageController();
        switch($currRoute){
            case 'about':
                $controller->aboutAction();
                break;
            default:
                $controller->homeAction();
                break;
        }

    }
}