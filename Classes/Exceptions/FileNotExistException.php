<?php

namespace Nik\Classes\Exceptions;

class FileNotExistException extends \Exception
{
    protected $message = 'File not exist!';

    public function __construct($code = 0, Exception $previous = null)
    {
        parent::__construct($this->message);
    }
}