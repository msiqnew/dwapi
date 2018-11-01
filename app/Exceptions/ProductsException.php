<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ProductsException extends BaseHttpException
{
    const PRODUCT_NOT_FOUND = 'no product for you';
    const PRODUCT_NOT_FOUND_CODE = 101;

    public function __construct($statusCode, $message, $code)
    {
        parent::__construct($statusCode, $message, null, [], $code);
    }

    public static function productNotFound(): self
    {
        return new self(Response::HTTP_NOT_FOUND, self::PRODUCT_NOT_FOUND, self::PRODUCT_NOT_FOUND_CODE);
    }
}
