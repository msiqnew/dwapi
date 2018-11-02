<?php

namespace App\Http\Resources;

use App\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CollectionResource extends AbstractFilterableResource
{
    /**
     * @var array
     */
    protected $withFields = ['id', 'name', 'size', 'products'];

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->filterFields([
            'id' => $this->id,
            'name' => $this->name,
            'size' => $this->size,
            'products' => ProductResource::collection(
                $this->products->map([$this, 'mapFieldsQuery'])),
        ]);
    }

    /**
     * @return ProductResource
     */
    public function mapFieldsQuery(Product $product): ProductResource
    {
        return (new ProductResource($product))
            ->includeFields(
                $this->relatedEntityFields('productFields')
            );
    }
}
