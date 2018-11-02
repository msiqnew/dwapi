<?php

namespace App\Repository;

use App\Product;

class ProductRepository
{
    /**
     * @param string $name
     * @param string $image
     * @param string $sku
     * @param int $collectionId
     * @return Product
     */
    public function create(string $name, string $image, string $sku, int $collectionId = null): Product
    {
        $product = new Product();
        $product->name = $name;
        $product->image = $image;
        $product->sku = $sku;
        $product->collection_id = $collectionId;

        return $product;
    }

    /**
     * @param Product $product
     * @return Product
     */
    public function persist(Product $product): Product
    {
        $product->save();
    }
}