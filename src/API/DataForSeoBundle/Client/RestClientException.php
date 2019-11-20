<?php

namespace App\API\DataForSeoBundle\Client;

use Exception;

class RestClientException extends Exception
{
    protected $http_code;

    //TODO В оригинальной либе - $http_code вставляется перед $code = 0;
    public function __construct($message, $http_code, $code = 0, Exception $previous = null)
    {
        $this->http_code = $http_code;
        parent::__construct($message, $code, $previous);
    }

    public function getHttpCode()
    {
        return $this->http_code;
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message} (HTTP status code: {$this->http_code})\n";
    }

}