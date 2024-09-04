<?php

namespace Symbiote\ApiWrapper;

class WebServiceException extends \Exception
{
    public function __construct(public $status = 403, $message = '', $code = null, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
