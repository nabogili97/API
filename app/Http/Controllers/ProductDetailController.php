<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductDetailRepository;
use App\Http\Resources\ProductDetailResource;
use App\Http\Requests\ProductDetailRequest;
use App\Models\ProductDetail;

class ProductDetailController extends Controller
{
    /**
     * @var Repository
     */
    protected $productDetailRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->productDetailRepository = new ProductDetailRepository();
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

        $productDetails = $this->productDetailRepository->search($params);
        $jsonProductDetails = ProductDetailResource::collection($productDetails);

        return $jsonProductDetails;
    }

    /**
     * Get list category with status = 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listProductDetail(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();
        $productDetails = $this->productDetailRepository->search($params);
        $jsonProductDetails = ProductDetailResource::collection($productDetails);

        return $jsonProductDetails;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Size\ProductDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductDetailRequest $request)
    {

        $product_id = $request->get('product_id');
        $size_id = $request->get('size_id');
        $qty = $request->get('qty');

        $data = ProductDetail::where([
            ['product_id', $product_id],
            ['size_id', $size_id]
        ])->get();

        foreach ($data as $item) {
            $product_id_data = $item->product_id;
            $size_id_data = $item->size_id;
            $qty_data = $item->qty;

            if($product_id_data == $product_id && $size_id_data == $size_id)
            {
                $total = $qty_data + $qty;
                ProductDetail::where([
                    ['product_id', $product_id],
                    ['size_id', $size_id]
                ])
                ->update(['qty' => $total]);
            } else {
                ProductDetail::create([
                    'product_id' => $product_id,
                    'size_id' => $size_id,
                    'qty' => $qty,
                ]);
            }


        }        

        // $productDetail = $this->productDetailRepository->create($request->all());
        // $jsonProductDetail = new ProductDetailResource($productDetail);

        // return $jsonProductDetail;

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
            $productDetail = $this->productDetailRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonProductDetail = new ProductDetailResource($productDetail);

        return $jsonProductDetail;
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
            $productDetail = $this->colorRepository->update($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonProductDetail = new ProductDetailResource($productDetail);

        return $jsonProductDetail;
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
            $result = $this->productDetailRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }

    public function join()
    {
        $productDetails = $this->productDetailRepository->join();
        return response()->json($productDetails);
    }
}
