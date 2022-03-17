<?php

namespace App\Http\Controllers;

use App\Repositories\BrandRepository;
use App\Http\Resources\BrandResource;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BrandController extends Controller
{
    /**
     * @var Repository
     */
    protected $brandRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->brandRepository = new BrandRepository();
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

        $brands = $this->brandRepository->search($params);
        $jsonBrands = BrandResource::collection($brands);

        return $jsonBrands;
    }

    /**
     * Get list category with status = 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listBrand(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();
        $params['conditions']['status'] = Brand::BRAND_ENABLED;

        $brands = $this->brandRepository->search($params);
        $jsonBrands = BrandResource::collection($brands);

        return $jsonBrands;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Category\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(BrandRequest $request)
    // {
    //     $brand = $this->brandRepository->create($request->all());
    //     $jsonBrand= new BrandResource($brand);

    //     return $jsonBrand;
    // }

    public function store(BrandRequest $request)
    {
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->status = $request->status;
        if($request->image){ 
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $name = 'brand/images/'. $image->getClientOriginalName();

            $target_dir    = "brand/images/";
            $target_file   = $target_dir . basename($_FILES["image"]["name"]);

            $brand->image = $target_file;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "File " . basename($_FILES["image"]["name"]) .
                " Đã upload thành công.";

                echo "File lưu tại " .
                $target_file;
            }

            
            $brand->image = $name;
        }else {
            $brand->image = 'defaul.jpg';
        }
        $brand->save();
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
            $brand = $this->brandRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonBrand = new BrandResource($brand);

        return $jsonBrand;
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
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->status = $request->status;
        if ($request->image) {
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $name = 'brand/images/' . $image->getClientOriginalName();

            $target_dir    = "brand/images/";
            $target_file   = $target_dir . basename($_FILES["image"]["name"]);

            $brand->image = $target_file;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "File " . basename($_FILES["image"]["name"]) .
                " Đã upload thành công.";

                echo "File lưu tại " .
                $target_file;
            }
            
            $brand->image = $name;
        }
        $brand->save();
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
            $brand = $this->brandRepository->update($request->only('status'), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonBrand = new BrandResource($brand);

        return $jsonBrand;
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
            $result = $this->brandRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }
}
