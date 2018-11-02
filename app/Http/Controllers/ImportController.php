<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Exceptions\CollectionsException;
use App\Exceptions\ProductsException;
use App\Http\Resources\CollectionCollection;
use App\Product;
use App\Repository\CollectionRepository;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImportController extends Controller
{
    /**
     * @var CollectionRepository $collectionRepo
     */
    private $collectionRepo;

    /**
     * @var ProductRepository $productRepo
     */
    private $productRepo;

    public function __construct(
        ProductRepository $productRepo,
        CollectionRepository $collectionRepo
    )
    {
        $this->productRepo = $productRepo;
        $this->collectionRepo = $collectionRepo;
    }

    /**
     * Import products
     *
     * @param Request $request
     * @return Response
     */
    public function import(Request $request)
    {
        $collections = $this->importProductsCollections(
            json_decode($request->getContent(), true)
        );

        $collections = collect($collections);

        foreach ($collections as $collection) {
            foreach ($collection->products() as $product) {
                $product->collection_id = $collection->id;
            }
            $collection->save();
            $collection->products()->saveMany($collection->products);
        }

        return new CollectionCollection($collections);

    }

    public function importProductsCollections(array $data)
    {
        return array_map(function ($collectionData) {
            $products = array_map([$this, 'deserializeProduct'], $collectionData['products']);
            $collection = $this->deserializeCollection($collectionData);
            array_walk($products, [$collection->products, 'add']);

            return $collection;
        }, $data);
    }

    public function deserializeCollection(array $data): Collection
    {
        $this->validateCollectionData($data);

        return $this->collectionRepo->create($data['name'], $data['size']);
    }

    public function deserializeProduct(array $data): Product
    {
        $this->validateProductData($data);

        return $this->productRepo->create($data['name'], $data['image'], $data['sku']);
    }

    /**
     * @param array $data
     * @return array
     */
    public function validateProductData(array &$data)
    {
        if (
            !array_key_exists('name', $data) ||
            !array_key_exists('image', $data) ||
            !array_key_exists('sku', $data)
        ) {
            throw ProductsException::unprocessableData();
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function validateCollectionData(array &$data)
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
    }
}
