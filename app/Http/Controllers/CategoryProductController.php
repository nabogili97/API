<?php



namespace App\Http\Controllers;

use App\Repositories\CategoryProductRepository;
use App\Http\Resources\CategoryProductResource;
use App\Http\Requests\CategoryProductRequest;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * @var Repository
     */
    protected $categoryProductRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->categoryProductRepository = new CategoryProductRepository();
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

        $categories = $this->categoryProductRepository->search($params);
        $jsonCategories = CategoryProductResource::collection($categories);

        return $jsonCategories;
    }

    /**
     * Get list CategoryProduct with status = 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listCategoryProduct(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();
        $params['conditions']['status'] = CategoryProduct::CATEGORY_PRODUCT_ENABLED;

        $categoryProduct = $this->categoryProductRepository->search($params);
        $jsonCategories = CategoryProductResource::collection($categoryProduct);

        return $jsonCategories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryProduct\CategoryProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryProductRequest $request)
    {
        $categoryProduct = $this->categoryProductRepository->create($request->all());
        $jsonCategoryProduct = new CategoryProductResource($categoryProduct);

        return $jsonCategoryProduct;
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
            $categoryProduct = $this->categoryProductRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonCategoryProduct = new CategoryProductResource($categoryProduct);

        return $jsonCategoryProduct;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CategoryProduct\CategoryProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryProductRequest $request, $id)
    {
        try {
            $categoryProduct = $this->categoryProductRepository->update($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonCategoryProduct = new CategoryProductResource($categoryProduct);

        return $jsonCategoryProduct;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CategoryProduct\CategoryProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePosition(Request $request)
    {
        foreach ($request->all() as $key => $value) {
        try {
            $categoryProduct = $this->categoryProductRepository->update($value, $value['id']);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonCategoryProduct[$key] = new CategoryProductResource($categoryProduct);
        }
        return $jsonCategoryProduct;
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
            $categoryProduct = $this->categoryProductRepository->update($request->only('status'), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonCategoryProduct = new CategoryProductResource($categoryProduct);

        return $jsonCategoryProduct;
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
            $result = $this->categoryProductRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }
}
