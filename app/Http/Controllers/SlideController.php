<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SlideRequest;
use App\Http\Resources\SlideResource;
use App\Repositories\SlideRepository;

class SlideController extends Controller
{

    protected $slideRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->slideRepository = new SlideRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();

        try {
            $response = $this->slideRepository->search($params);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSlide = SlideResource::collection($response);

        return  $jsonSlide;
    }

    /**
     * Store post
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SlideRequest $request)
    {
        try {
            $response = $this->slideRepository->store($request->all());
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSlide = new SlideResource($response);
        return $jsonSlide;
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
            $response  = $this->slideRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSlide = new SlideResource($response);
        return $jsonSlide;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Thing\SettingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $response = $this->slideRepository->updateSlide($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = new SlideResource($response);
        return $jsonSetting;
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
            $response  = $this->slideRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($response);
    }
}
