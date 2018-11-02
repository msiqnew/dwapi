<?php

namespace App\Http\Resources;

use App\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

class ProductCollection extends ResourceCollection
{
    use FilterableCollection;

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => ProductResource::collection(
                $this->collection->map(function (Product $product) {
                    return (new ProductResource($product))
                        ->includeFields($this->withFields);
                })),
            'meta' => []
        ];
    }
}
