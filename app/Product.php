<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
