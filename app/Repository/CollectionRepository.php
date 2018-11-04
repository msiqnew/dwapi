<?php

namespace App\Repository;

use App\Collection;

class CollectionRepository
{
    /**
     * @param string $name
     * @param int $size
     * @return Collection
     */
    public function create(string $name, int $size)
    {
        $collection =  new Collection();
        $collection->name = $name;
        $collection->size = $size;

        return $collection;
    }

    public function persist(Collection $product)
    {
        $product->save();
    }
}
