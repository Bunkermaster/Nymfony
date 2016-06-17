<?php
namespace Helper;

use Model\TrafficTrackerRepository;

/**
 * Class TrafficTracker
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package core\Helper
 */
class TrafficTracker
{
    public static function init()
    {
        /** @var Request $request */
        $request = ServiceContainer::getService('Request');
        $route = Router::getCurrentRoute();
        $trafficTracker = new TrafficTrackerRepository();
        return $trafficTracker->insert([
            'uri' => $request->URI,
            'http_method' => $request->HTTP['method'],
            'route_identifier' => $route->routeIdentifier,
            'session_id' => session_id(),
            'http_referer' => $request->HTTP_REFERER,
            'http_user_agent' => $request->USER_AGENT,
            'headers' => json_encode($request->headers),
        ]);
    }
}
