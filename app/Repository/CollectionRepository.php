<?php

namespace App\Repository;

use App\Collection;
use App\Product;

class CollectionRepository
{


    public function create(string $name, int $size, array $products = [])
    {
        $collection =  new Collection();
        $collection->name = $name;
        $collection->size = $size;

         return $collection;
    }

    public function persist(Product $product)
    {
        $product->save();
    }
}