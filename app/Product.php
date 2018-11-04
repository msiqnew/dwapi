<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\CollectionFilter;

class Product extends Model
{
//    public function scopeFilter(Builder $builder, $request)
//    {
//        return (new CollectionFilter($request))->filter($builder);
//    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'image', 'sku'];

    public function collection()
    {
        return $this->blongsTo(Collection::class);
    }
}
