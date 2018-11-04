<?php

namespace App\Services;

use App\Collection;
use App\Product;
use App\Repository\CollectionRepository;
use App\Repository\ProductRepository;
use App\Exceptions\ProductsException;
use App\Exceptions\CollectionsException;

use Illuminate\Support\Collection as ArrayCollection;

class ImportService
{
    /**
     * @var ProductRepository $productRepo
     */
    private $productRepo;

    /**
     * @var CollectionRepository $collectionRepo
     */
    private $collectionRepo;

    /**
     * ImportService constructor.
     * @param ProductRepository $productRepository
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        CollectionRepository $collectionRepository
    ) {
        $this->productRepo = $productRepository;
        $this->collectionRepo = $collectionRepository;
    }

    /**
     *Imports Collection and products from array data
     *
     * [
     * {
     * "collection" | "name" : string,
     * "size": int,
     * "products": [
     * {
     * "image": string,
     * "name": string,
     * "sku": string,
     * },
     *      ...
     *  ]
     *  }
     *  ...
     * ]
     * @param array $data in this^ form
     * @return ArrayCollection
     */
    public function importProductsCollections(array $data): ArrayCollection
    {
        $collections = array_map(function ($data) {
            $products = array_map([$this, 'deserializeProduct'], $data['products']);
            $collection = $this->deserializeCollection($data);
            array_walk($products, [$collection->products, 'add']);

            return $collection;
        }, $data);


        return $this->persistCollections(collect($collections));
    }

    private function persistCollections(ArrayCollection $collections): ArrayCollection
    {
        $collections->map(function ($collection) {
            $collection->save();
            $collection->products()->saveMany($collection->products);
        });

        return $collections;
    }

    /**
     * Make collection model
     *
     * @param array $data
     * @return Collection
     */
    private function deserializeCollection(array $data): Collection
    {
        $data = $this->validateFormatCollectionData($data);

        return $this->collectionRepo->create($data['name'], $data['size']);
    }

    /**
     * Make Product model
     *
     * @param array $data
     * @return Product
     */
    private function deserializeProduct(array $data): Product
    {
        $data = $this->validateFormatProductData($data);

        return $this->productRepo->create($data['name'], $data['image'], $data['sku']);
    }

    /**
     * If $data has info to create Product Model
     *
     * @param array $data
     * @return array
     */
    private function validateFormatProductData(array $data): array
    {
        if (
            !array_key_exists('name', $data) ||
            !array_key_exists('image', $data) ||
            !array_key_exists('sku', $data)
        ) {
            throw ProductsException::unprocessableData();
        }

        return $data;
    }

    /**
     * If $data has info to create Collection Model
     *
     * @param array $data
     * @return array
     */
    private function validateFormatCollectionData(array $data): array
    {
        if (!array_key_exists('name', $data)) {
            if (array_key_exists('collection', $data)) {
                $data['name'] = $data['collection'];
            } else {
                throw CollectionsException::unprocessableData();
            }
        }

        if (!array_key_exists('size', $data)) {
            throw CollectionsException::unprocessableData();
        }

        return $data;
    }
}
