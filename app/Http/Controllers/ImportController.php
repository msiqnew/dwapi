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

use App\Services\ImportService;

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

    private $importService;

    public function __construct(
        ImportService $importService,
        ProductRepository $productRepo,
        CollectionRepository $collectionRepo
    )
    {
        $this->importService = $importService;
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
        $collections = $this->importService
            ->importProductsCollections(
                json_decode($request->getContent(), true)
            );

        return (new CollectionCollection($collections))
            ->response()
            ->setStatusCode(201);
    }
}
