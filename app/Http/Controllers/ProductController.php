<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Exceptions\ProductsException;

class ProductController extends Controller
{
    private $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $fields = $this->processQuery($request);
        $productRepo = new ProductRepository();
        $productRepo->findAll($request);

        return (new ProductCollection($productRepo->findAll($request)))->includeFields($fields);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return Response
     */
    public function show(Product $product, Request $request)
    {
        if ($product) {
            $fields = $this->processQuery($request);
            return (new ProductResource($product))->includeFields($fields);
        }

        throw ProductsException::ProductNotFound();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        if ($product) {
            return response()->json([], 204);
        }

        throw ProductsException::productNotFound();
    }
}
