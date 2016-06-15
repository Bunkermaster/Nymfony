<?php
namespace Helper;

use Helper\Router;
use Helper\ServiceContainer;

/**
 * Class TrafficTracker
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package core\Helper
 */
class TrafficTracker
{
    public static function trackIt()
    {
        $request = ServiceContainer::getService('Request');
        $route = Router::getCurrentRoute();
        
    }
}
