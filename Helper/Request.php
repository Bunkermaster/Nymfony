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
     * Request constructor.
     */
    public function __construct()
    {
<<<<<<< HEAD
        $this->COOKIE = $_COOKIE ?? [];
        $this->GET = $_GET ?? [];
        $this->SESSION = $_SESSION ?? [];
        $this->POST = $_POST ?? [];
        $this->URI = $_SERVER['REQUEST_URI'] ?? false;
=======
        $this->COOKIE = $_COOKIE;
        $this->GET = $_GET;
        $this->SESSION = $_SESSION ?? [];
        $this->POST = $_POST;
        $this->URI = $_SERVER['REQUEST_URI'];
>>>>>>> a3e66c70649e9529d64871a179dce9d0a4b6a220
        $this->HTTP = [];
        // reference OPTIONS GET HEAD POST PUT DELETE TRACE CONNECT PATCH
        $this->HTTP['method'] = $_SERVER['REQUEST_METHOD'] ?? false;
        $this->IP = $_SERVER['REMOTE_ADDR'] ?? false;
        $this->USER_AGENT = $_SERVER['HTTP_USER_AGENT'] ?? false;
    }
}
