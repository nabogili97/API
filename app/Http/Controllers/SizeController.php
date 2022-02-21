<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SizeRepository;
use App\Http\Resources\SizeResource;
use App\Http\Requests\SizeRequest;
use App\Models\Size;

class SizeController extends Controller
{
    /**
     * @var Repository
     */
    protected $sizeRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->sizeRepository = new SizeRepository();
    }

    /**
     * Find data by multiple fields.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();

        $sizes = $this->sizeRepository->search($params);
        $jsonSizes = SizeResource::collection($sizes);

        return $jsonSizes;
    }

    /**
     * Get list category with status = 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listSize(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();

        $sizes = $this->sizeRepository->search($params);
        $jsonSizes = SizeResource::collection($sizes);

        return $jsonSizes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Size\SizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeRequest $request)
    {
        $size = $this->sizeRepository->create($request->all());
        $jsonSize = new SizeResource($size);

        return $jsonSize;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $size = $this->sizeRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSize = new SizeResource($size);

        return $jsonSize;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Size\SizeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $size = $this->sizeRepository->update($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSize = new SizeResource($size);

        return $jsonSize;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = $this->sizeRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }
}
