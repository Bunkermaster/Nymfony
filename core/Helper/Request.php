<?php
namespace Helper;

/**
 * Class Request
 * @package Helper
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class Request
{
    /**
     * @var array
     */
    public $HTTP;
    /**
     * @var string
     */
    public $URI;
    /**
     * @var array
     */
    public $GET;
    /**
     * @var array
     */
    public $POST;
    /**
     * @var array
     */
    public $SESSION;
    /**
     * @var array
     */
    public $COOKIE;
    /**
     * @var string
     */
    public $IP;
    /**
     * @var string
     */
    public $USER_AGENT;
    /**
     * @var string
     */
    public $HTTP_REFERER;
    /**
     * @var array
     */
    public $headers;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->COOKIE = $_COOKIE ?? [];
        $this->GET = $_GET ?? [];
        $this->SESSION = $_SESSION ?? [];
        $this->POST = $_POST ?? [];
        $this->URI = $_SERVER['REQUEST_URI'] ?? false;
        $this->HTTP = [];
        // reference OPTIONS GET HEAD POST PUT DELETE TRACE CONNECT PATCH
        $this->HTTP['method'] = $_SERVER['REQUEST_METHOD'] ?? false;
        $this->IP = $_SERVER['REMOTE_ADDR'] ?? false;
        $this->USER_AGENT = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $this->HTTP_REFERER = $_SERVER['HTTP_REFERER'] ?? '';
        $this->headers = \getallheaders();
    }
}
