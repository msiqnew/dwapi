<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductsException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return new ProductCollection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
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
    public function show(Product $product)
    {
        throw ProductsException::ProductNotFound();

        if ($product) {
            return new ProductResource($product);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
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
            dump($product::destry());
            return response()->json([], 204);
        }

        throw new \Exception('product not found', 404);
    }
}
