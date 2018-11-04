<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CollectionSizeFilter
{
    public function filter(Builder $builder, string $value)
    {
        return $builder->where('size', $value);
    }
}
