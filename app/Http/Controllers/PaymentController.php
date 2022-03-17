<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaymentRepository;
use App\Http\Resources\PaymentResoure;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * @var Repository
     */
    protected $paymentRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->paymentRepository = new PaymentRepository();
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

        $payments = $this->paymentRepository->search($params);
        $jsonPayments = PaymentResoure::collection($payments);

        return $jsonPayments;
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

        $payments = $this->paymentRepository->search($params);
        $jsonSizes = PaymentResoure::collection($payments);

        return $jsonSizes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Size\SizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payments = $this->paymentRepository->create($request->all());
        $jsonPayments = new PaymentResoure($payments);

        return $jsonPayments;
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
            $payment = $this->paymentRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonPayment = new PaymentResoure($payment);

        return $jsonPayment;
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
            $payment = $this->paymentRepository->update($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonPayment = new PaymentResoure($payment);

        return $jsonPayment;
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
            $result = $this->paymentRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }
}
