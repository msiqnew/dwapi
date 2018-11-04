<?php

namespace App\Filters;

class CollectionFilter extends AbstractFilter
{
    protected $filters = [
        'filter_collection_size' => CollectionSizeFilter::class
    ];
}
