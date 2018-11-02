<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseHttpException extends HttpException
{
    /**
     * BaseHttpException constructor.
     * @param int $statusCode
     * @param string $message
     * @param int $code
     */
    public function __construct(int $statusCode, string $message, int $code)
    {
        parent::__construct($statusCode, $message, null, [], $code);
    }
}