<?php

namespace App\Exceptions;

use Exception;

class TransactionException extends Exception
{
    private $errors;

    public function __construct($errors, $code = 0, Exception $anterior = null)
    {
        $this->errors = $errors;

        parent::__construct($this->generateMessage($errors), $code, $anterior);
    }

    public function getErrors() : array
    {
        return $this->errors;
    }

    private function generateMessage(array $errors)
    {
        $message = '';

        foreach ($errors as $field => $error)
        {
            $message .= $field.': '.$error.'; ' ;
        }

        return $message;
    }
}