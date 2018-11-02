<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Collection;
use App\Http\Resources\CollectionCollection;
use App\Http\Resources\CollectionResource;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $fields = $this->processQuery($request, 'productFields');
        return (new CollectionCollection(Collection::all()))->includeFields($fields);
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
     * @param Collection $collection
     * @return Response
     */
    public function show(Collection $collection, Request $request)
    {
        $fields = $this->processQuery($request, 'productFields');
        return (new CollectionResource($collection))->includeFields($fields);
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
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
