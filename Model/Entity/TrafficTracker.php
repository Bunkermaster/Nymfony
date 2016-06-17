<?php
namespace Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TrafficTracker
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Entity
 * @ORM\Entity(repositoryClass="Model\TrafficTrackerRepository")
 * @ORM\Table(name="trafficTracker")
 */
class TrafficTracker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string",length=40)
     */
    private $session_id;
    /**
     * @ORM\Column(type="string",length=100)
     */
    private $route_identifier;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $uri;
    /**
     * @ORM\Column(type="string",length=30)
     */
    private $http_method;
    /**
     * @ORM\Column(type="string")
     */
    private $http_referer;

    /**
     * @return mixed
     */
    public function getHttpReferer()
    {
        return $this->http_referer;
    }

    /**
     * @param mixed $http_referer
     * @return $this
     */
    public function setHttpReferer($http_referer)
    {
        $this->http_referer = $http_referer;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * @param mixed $session_id
     * @return $this
     */
    public function setSessionId($session_id)
    {
        $this->session_id = $session_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRouteIdentifier()
    {
        return $this->route_identifier;
    }

    /**
     * @param mixed $route_identifier
     * @return $this
     */
    public function setRouteIdentifier($route_identifier)
    {
        $this->route_identifier = $route_identifier;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     * @return $this
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHttpMethod()
    {
        return $this->http_method;
    }

    /**
     * @param mixed $http_method
     * @return $this
     */
    public function setHttpMethod($http_method)
    {
        $this->http_method = $http_method;

        return $this;
    }


}