<?php
namespace Model;

use Helper\Repository;
use Model\Entity\TrafficTracker;

/**
 * Class TrafficTracker
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Model
 */
class TrafficTrackerRepository extends Repository
{

    /**
     * Entity name
     * @var string
     */
    protected $entity = 'Model\\Entity\\TrafficTracker';

    /**
     * @param array $data
     * @return int insert id
     */
    public function insert($data)
    {
        $trafficTracker = new TrafficTracker();
        $trafficTracker->setCreatedAt(new \DateTime())
            ->setHttpMethod($data['http_method'])
            ->setRouteIdentifier($data['route_identifier'])
            ->setSessionId($data['session_id'])
            ->setHttpReferer($data['http_referer'])
            ->setHttpUserAgent($data['http_user_agent'])
            ->setUri($data['uri'])
            ->setHeaders($data['headers']);
        $this->entityManager->persist($trafficTracker);
        $this->entityManager->flush();
        return $trafficTracker->getId();
    }
}
