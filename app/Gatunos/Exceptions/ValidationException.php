<?php namespace Gatunos\Exceptions;

use Exception;

class ValidationException extends Exception {

    protected $errors;

    function __construct($message, $errors, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}