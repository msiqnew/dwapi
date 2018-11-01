<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class CollectionsException extends BaseHttpException
{
    const COLLECTION_NOT_FOUND = 'no collection for you';
    const COLLECTION_NOT_FOUND_CODE = 203;

    public static function collectionNotFound(): self
    {
        return new self(Response::HTTP_NOT_FOUND, self::COLLECTION_NOT_FOUND, self::COLLECTION_NOT_FOUND_CODE);
    }
}
