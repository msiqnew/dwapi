<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

trait QueryRequests
{
    /**
     * @param Request $request
     * @param string $relatedFields
     * @return array
     */
    protected function processQuery(Request $request, string $relatedFields = '')
    {
        return array_merge(
            $this->queryFieldsToArray($request->query('fields', '')),
            $this->queryFieldsToArray($request->query($relatedFields, ''), $relatedFields)
        );
    }

    /**
     * @param string $queryFields
     * @param string $root
     * @return array
     */
    protected function queryFieldsToArray(string $queryFields, $root = '')
    {
        $array = [];
        if (!empty($queryFields)) {
            $array['fields'] = explode(',', str_replace(' ', '', $queryFields));
        }

        if ($array && !empty($root)) {
            $array = [$root => $array];
        }

        return $array;
    }
}