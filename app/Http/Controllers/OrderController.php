<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Http\Resources\OrderResource;
use App\Http\Requests\ColorRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * @var Repository
     */
    protected $corderRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
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

        $orders = $this->orderRepository->search($params);
        $jsonOrders = OrderResource::collection($orders);

        return $jsonOrders;
    }

    /**
     * Get list category with status = 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listOrder()
    {
        // $params = $request->all();
        // $params['conditions'] = $request->all();

        // $orders = $this->orderRepository->search($params);
        // $jsonOrders = OrderResource::collection($orders);

        $order = DB::table('payments')->where('user_id',1)->get();

        return response()->json($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Size\SizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorRequest $request)
    {
        $orders = $this->orderRepository->create($request->all());
        $jsonOrders = new OrderResource($orders);

        return $jsonOrders;
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
            $orders = $this->orderRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonOrders = new OrderResource($orders);

        return $jsonOrders;
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
            $orders = $this->orderRepository->update($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonOrders = new OrderResource($orders);

        return $jsonOrders;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeItemOrder($id)
    {
        try {
            $result = $this->orderRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }
}
