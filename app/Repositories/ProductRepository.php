<?php


namespace App\Repositories;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     *
     */
    public function boot()
    {
        //
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    /**
     * Find data by multiple fields
     *
     * @param array $params
     * @return mixed
     */
    public function search($params)
    {
        $conditions = $this->getSearchConditions($params);
        $conditionsFormated = [];

        if (isset($conditions['name'])) {
            $conditionsFormated[] = ['name', 'like', '%' . $params['name'] . '%'];
        }

        if (isset($conditions['public_start_at'])) {
            $conditionsFormated[] = ['public_start_at', '>=', $params['public_start_at']];
        }

        if (isset($conditions['public_end_at'])) {
            $conditionsFormated[] = ['public_end_at', '>=', $params['public_end_at']];
        }

        if (isset($conditions['status'])) {
            $conditionsFormated[] = ['status', '=', $conditions['status']];
        }

        if (isset($conditions['category_id'])) {
            $conditionsFormated[] = ['category_id', '=', $conditions['category_id']];
        }

        if (isset($conditions['content'])) {
            $conditionsFormated[] = ['content', 'like', '%' . $params['content'] . '%'];
        }

        if (isset($conditions['sortBy'])) {
            $this->orderBy($params['sortBy'], $params['sortType'] == 1 ? 'asc' : 'desc');
        }
        

        $columns = [
            "category_id",
            "name",
            "description",
            "qty",
            "viewed",
            "retail_price",
            "image",
            "status",
        ];
        if (isset($params['isContent']))
        {
            array_push($columns, 'content');
        }
        $params['conditions'] = $conditionsFormated;
        $params['sortBy'] = 'id';
        $params['limit'] = 10;
        $result = $this->searchByParams($params);

        return $result;
    }

    /**
     *  Store product save file img to folder storage/product/img
     *
     * @param array $params
     * @return mixed
     */

    public function store($params)
    {
        $file = $params['image'];
        $nameFile = Carbon::now()->timestamp . $file->getClientOriginalName();

        Storage::putFileAs('public/product/img', $file, $nameFile);
        $url = config('app.url') . '/storage/product/img/' . $nameFile;
        $params['image'] = $url;
        return $this->create($params);
    }

    /**
     *  Store product save file img to folder storage/product/img
     *
     * @param array $params
     * @return mixed
     */
    public function updateProduct($params, $id)
    {
        $product = Product::find($id);
        if ($params['image'] != $product->image) {
            $file = $params['image'];
            $nameFile = Carbon::now()->timestamp . $file->getClientOriginalName();

            Storage::putFileAs('public/product/img', $file, $nameFile);
            $url = config('app.url') . '/storage/product/img/' . $nameFile;
            $params['image'] = $url;

            Storage::delete($product->img);
        }
        return $this->update($params, $id);
    }

    public function listPro() {
        
    }

}
