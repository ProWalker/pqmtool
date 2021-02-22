<?php

namespace PQMTool\Classes\Exceptions;

use Exception;

class QuestionDataException extends Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
}