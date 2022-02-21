<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ConsultingRepository;
use App\Http\Resources\ConsultingResource;

class ConsultingController extends Controller
{
    /**
     * @var Repository
     */
    protected $consultingRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->consultingRepository = new ConsultingRepository();
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

        $consulting = $this->consultingRepository->search($params);
        $jsonConsulting = ConsultingResource::collection($consulting);

        return $jsonConsulting;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Category\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $consulting = $this->consultingRepository->create($request->all());
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonConsulting = new ConsultingResource($consulting);

        return $jsonConsulting;
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
            $consulting = $this->consultingRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonConsulting = new ConsultingResource($consulting);

        return $jsonConsulting;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Category\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $consulting = $this->consultingRepository->update($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonConsulting = new ConsultingResource($consulting);

        return $jsonConsulting;
    }

    /**
     * Update Status.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $consulting = $this->consultingRepository->update($request->only('status'), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonConsulting = new ConsultingResource($consulting);

        return $jsonConsulting;
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
            $result = $this->consultingRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }
}
