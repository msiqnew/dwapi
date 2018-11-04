<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Input;
use App\Collection;
use App\Http\Resources\CollectionCollection;
use App\Http\Resources\CollectionResource;
use App\Repository\CollectionRepository;

class CollectionController extends Controller
{
    /**
     * @var CollectionRepository
     */
    private $collectionRepo;

    /**
     * CollectionController constructor.
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->collectionRepo = $collectionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $fields = $this->processQuery($request, 'productFields');
        return (new CollectionCollection(
            Collection::filter($request)->get()
        ))->includeFields($fields);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
//        dump('incontttttttt', $request);
        $collRepo = new CollectionRepository();
        $collection = $collRepo->create(
            Input::get('name'),
            Input::get('size')
        );
        $collRepo->persist($collection);

        return new CollectionResource($collection);
//        return response()->json($collection, 201);
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
