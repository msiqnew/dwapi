<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseHttpException extends HttpException
{
    public function __construct($statusCode, $message, $code)
    {
        parent::__construct($statusCode, $message, null, [], $code);
    }
}