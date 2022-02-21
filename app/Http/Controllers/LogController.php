<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LogRepository;
use App\Http\Resources\LogResource;

class LogController extends Controller
{
        /**
     * @var Repository
     */
    protected $logRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->logRepository = new LogRepository();
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

        $logs = $this->logRepository->search($params);
        $jsonLogs = LogResource::collection($logs);

        return $jsonLogs;
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
            $log = $this->logRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonLog = new LogResource($log);

        return $jsonLog;
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
            $log = $this->logRepository->update($request->only('status'), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonLog = new LogResource($log);

        return $jsonLog;
    }
}