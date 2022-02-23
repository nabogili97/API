<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
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
            $response = $this->productRepository->search($params);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = ProductResource::collection($response);

        return  $jsonSetting;
    }

    /**
     * Get list product with status = 1
     *
     * @return \Illuminate\Http\Response
     */
    public function listProduct(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();
        $params['conditions']['status'] = Product::STATUS_PRODUCT_ENABLED;
        $params['isContent'] = true;
        try {
            $response = $this->productRepository->search($params);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = ProductResource::collection($response);
        return  $jsonSetting;
    }

    /**
     * Store product
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productRepository->create($request->all());
        $jsonProduct = new ProductResource($product);

        return $jsonProduct;
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
            $response  = $this->productRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = new ProductResource($response);
        return $jsonSetting;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Thing\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $response = $this->productRepository->updateProduct($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = new ProductResource($response);
        return $jsonSetting;
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
            $response = $this->productRepository->update($request->only('status'), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = new ProductResource($response);

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
            $response  = $this->productRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($response);
    }

    public function productDetailList(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();

        try {
            $response = $this->productRepository->search($params);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = ProductResource::collection($response);

        return  $jsonSetting;
    }

    public function productLists() {

        $data = Product::with(['size','color'])->get();

        return response()-> json($data);

    }

    public function productShow($id)
    {

        $data = Product::with(['size', 'color'])->where('id', $id)->get();

        return response()->json($data);
    }

    public function productByCategory($id)
    {

        $data = Product::where('category_id', $id)->get();

        return response()->json($data);
    }

    public function productByBrand($id)
    {

        $data = Product::where('brand_id', $id)->get();

        return response()->json($data);
    }

    public function productByColor($id)
    {

        $data = Product::with('color')->where('id', $id)->get();

        return response()->json($data);
    }


}
