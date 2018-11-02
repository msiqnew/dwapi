<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class ProductResource extends AbstractFilterableResource
{
    /**
     * @var array
     */
    protected $withFields = ['id', 'name', 'image', 'sku', 'collection_id'];

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->filterFields([
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'image' => $this->image,
            'collection_id' => $this->collection_id,
        ]);
    }
}
