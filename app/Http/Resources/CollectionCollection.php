<?php

namespace App\Http\Resources;

use App\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

class CollectionCollection extends ResourceCollection
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
            'data' => CollectionResource::collection(
                $this->collection->map(function (Collection $collection) {
                    return (new CollectionResource($collection))
                        ->includeFields($this->withFields);
                })),
            'meta' => []
        ];
    }
}
