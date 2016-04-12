<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 12/04/16
 * Time: 11:49
 */

namespace Helper;


/**
 * Class Request
 * @package Helper
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
     * @var
     */
    public $GET;
    /**
     * @var
     */
    public $POST;
    /**
     * @var
     */
    public $COOKIE;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->COOKIE = $_COOKIE;
        $this->GET = $_GET;
        $this->POST = $_POST;
        $this->URI = $_SERVER['REQUEST_URI'];
        $this->HTTP = [];
        $this->HTTP['method'] = $_SERVER['REQUEST_METHOD'];
    }
}