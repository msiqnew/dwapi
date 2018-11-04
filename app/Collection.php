<?php

namespace App;

use App\Filters\CollectionFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Collection extends Model
{
    public function scopeFilter(Builder $builder, $request)
    {
        return (new CollectionFilter($request))->filter($builder);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'size'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
