<?php

namespace PQMTool\Classes\Exceptions;

class QuestionFormatException extends \Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message);
    }
}