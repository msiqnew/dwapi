<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function collection()
    {
        return $this->blongsTo(Collection::class);
    }
}
