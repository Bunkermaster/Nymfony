<?php
namespace Helper;

/**
 * Class Response
 * @package Helper
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class Response
{
    /**
     * @var array
     */
    private $headers = [];
    /**
     * @var string
     */
    private $body;
    /**
     * @var int|null
     */
    private $status;
    private $defaultStatus = 200;

    /**
     * @const array
     */
    private $statusReference = [
        "100" => "100  Continue",
        "101" => "101  Switching Protocols",
        "200" => "200  OK",
        "201" => "201  Created",
        "202" => "202  Accepted",
        "203" => "203  Non-Authoritative Information",
        "204" => "204  No Content",
        "205" => "205  Reset Content",
        "300" => "300  Multiple Choices",
        "301" => "301  Moved Permanently",
        "302" => "302  Found",
        "303" => "303  See Other",
        "305" => "305  Use Proxy",
        "306" => "306  (Unused)",
        "307" => "307  Temporary Redirect",
        "400" => "400  Bad Request",
        "402" => "402  Payment Required",
        "403" => "403  Forbidden",
        "404" => "404  Not Found",
        "405" => "405  Method Not Allowed",
        "406" => "406  Not Acceptable",
        "408" => "408  Request Timeout",
        "409" => "409  Conflict",
        "410" => "410  Gone",
        "411" => "411  Length Required",
        "413" => "413  Payload Too Large",
        "414" => "414  URI Too Long",
        "415" => "415  Unsupported Media Type",
        "417" => "417  Expectation Failed",
        "426" => "426  Upgrade Required",
        "500" => "500  Internal Server Error",
        "501" => "501  Not Implemented",
        "502" => "502  Bad Gateway",
        "503" => "503  Service Unavailable",
        "504" => "504  Gateway Timeout",
        "505" => "505  HTTP Version Not Supported"
    ];
    
    /**
     * Response constructor.
     * @param string $body
     * @param int $status
     * @param string|array $headers
     */
    public function __construct($body = null, $status = null, $headers = null)
    {
        if (!is_null($body)) {
            $this->addBody($body);
        } else {
            $this->addBody('');
        }
        if (!is_null($headers)) {
            $this->addHeader($headers);
        }
        if (!is_null($status)) {
            $this->status = $status;
        } else {
            $this->status = $this->defaultStatus;
        }
    }

    /**
     * @param $bodyPart
     * @return $this
     */
    public function addBody($bodyPart)
    {
        $this->body .= $bodyPart;

        return $this;
    }

    /**
     * Function to add a header to Response
     * @param string|array $header
     * @return $this
     */
    public function addHeader($header)
    {
        if (is_array($header)) {
            $this->headers = array_merge($this->headers, $header);
        } elseif (is_string($header)) {
            $this->headers[] = $header;
        }
        
        return $this;
    }

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        if (isset($this->statusReference[$status])) {
            $this->status = $status;
        } else {
            $this->status = $this->defaultStatus;
        }
        
        return $this;
    }
    
    /**
     * output the HTTP response
     */
    public function output()
    {
        foreach ($this->headers as $header) {
            header($header);
        }
        http_response_code($this->status);
        if (APP_DEV_MODE === true) {
            Profiler::setOutputSize(strlen($this->body));
        }
        echo $this->body;
    }
}
