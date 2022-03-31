<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Rating;
use App\Http\Resources\RatingResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // $data = Product::with(['size'])->get();

        // return response()->json($data);

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

    public function SaleProductList(Request  $request)
    {
        $data = DB::table('products')->where('discount', '>' , 0)->get();

        return response()->json($data);
    }

    /**
     * Store product
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
       try {
            $response = $this->productRepository->store($request->all());
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonProduct = new ProductResource($response);
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

        $data = Product::with(['size', 'productDetails'])->where('id', $id)->get();

        return response()->json($data);

        // try {
        //     $response  = $this->productRepository->findOrFail($id);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'data' => ['errors' => ['exception' => $th->getMessage()]]
        //     ], 400);
        // }
        // $jsonSetting = new ProductResource($response);
        // return $jsonSetting;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Thing\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->retail_price = $request->retail_price;
        $product->description = $request->description;
        $product->content = $request->content;
        $product->status = $request->status;
        if ($request->image) {
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $name = 'product/images/' . $image->getClientOriginalName();

            $target_dir    = "product/images/";
            $target_file   = $target_dir . basename($_FILES["image"]["name"]);

            $product->image = $target_file;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "File " . basename($_FILES["image"]["name"]) .
                " Đã upload thành công.";

                echo "File lưu tại " .
                $target_file;
            }
            $product->image = $name;
        }
        $product->save();
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

    public function productLists(Request $request) {

        // $data = Product::with(['size','color'])->get();

        // return response()-> json($data);

        $params = $request->all();
        $params['conditions'] = $request->all();

        $products = $this->productRepository->search($params);
        $jsonProducts = ProductResource::collection($products);

        return $jsonProducts;

    }

    public function productShow($id)
    {

        // $data = Product::with(['size'])->where('id', $id)->get();

        // return response()->json($data);

        try {
            $product = $this->productRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonBrand = new ProductResource($product);

        return $jsonBrand;
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

    public function productBySize($id)
    {
        // $data = Product::with('size')->where('size', )->get();

        // return response()->json($data);

        $data = DB::table('product_details')->join('products', 'products.id', '=', 'product_details.product_id')
        ->join('sizes', 'sizes.id', 'product_details.size_id')
        ->select('product_details.*', 'products.*', 'sizes.*')
        ->where('size_id', $id)
        ->paginate(15);

        return response()->json($data);
    }

    public function upload(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
        ]);

        $fileUpload = new Product;

        if ($request->file()) {
            $file_name = time() . '_' . $request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

            $fileUpload->name = time() . '_' . $request->file->getClientOriginalName();
            $fileUpload->path = '/storage/' . $file_path;
            $fileUpload->save();

            return response()->json(['success' => 'File uploaded successfully.']);
        }
    }

    public function setrating(Request $request)
    {
        return new RatingResource(
            Rating::create([
                'product_id' => $request->get('product_id'),
                'user_id' => $request->get('user_id'),
                'rating' => $request->get('rating')
            ])
        );
    }


}
