<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ColorRepository;
use App\Http\Resources\ColorResource;
use App\Http\Requests\ColorRequest;
use App\Models\Color;

class ColorController extends Controller
{
    /**
     * @var Repository
     */
    protected $colorRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->colorRepository = new ColorRepository();
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

        $colors = $this->colorRepository->search($params);
        $jsonColors = ColorResource::collection($colors);

        return $jsonColors;
    }

    /**
     * Get list category with status = 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listColor(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();

        $colors = $this->colorRepository->search($params);
        $jsonColors = ColorResource::collection($colors);

        return $jsonColors;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Size\SizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorRequest $request)
    {
        $color = $this->colorRepository->create($request->all());
        $jsonColor = new ColorResource($color);

        return $jsonColor;
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
            $color = $this->colorRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonColor = new ColorResource($color);

        return $jsonColor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Size\ColorRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $color = $this->colorRepository->update($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonColor = new ColorResource($color);

        return $jsonColor;
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
            $result = $this->colorRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }
}
