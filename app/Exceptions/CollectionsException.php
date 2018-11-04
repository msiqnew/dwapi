<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class CollectionsException extends BaseHttpException
{
    const COLLECTION_NOT_FOUND = 'no collection for you';
    const COLLECTION_NOT_FOUND_CODE = 201;
    const UNPROCESSABLE_DATA = 'Data is not valid';
    const UNPROCESSABLE_DATA_CODE = 202;

    /**
     * @return CollectionsException
     */
    public static function collectionNotFound(): CollectionsException
    {
        return new self(
            Response::HTTP_NOT_FOUND,
            self::COLLECTION_NOT_FOUND,
            self::COLLECTION_NOT_FOUND_CODE
        );
    }

    /**
     * @return CollectionsException
     */
    public static function unprocessableData(): CollectionsException
    {
        return new self(
            Response::HTTP_UNPROCESSABLE_ENTITY,
            self::UNPROCESSABLE_DATA,
            self::UNPROCESSABLE_DATA_CODE
        );
    }
}
