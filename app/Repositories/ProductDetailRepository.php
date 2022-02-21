<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\ProductDetail;

class ProductDetailRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductDetail::class;
    }

    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     */
    public function search($params)
    {
        $conditions = $this->getSearchConditions($params);
        $conditionsFormated = [];

        if (isset($conditions['size_value'])) {
            $conditionsFormated[] = ['size_value', 'like', '%' . $params['size_value'] . '%'];
        }

        $params['sortBy'] = 'id';
        $params['sortType'] =  'asc';
        $this->orderBy($params['sortBy'], $params['sortType']);
        $params['conditions'] = $conditionsFormated;
        $result = $this->searchByParams($params);

        return $result;
    }

    public function join()
    {
        return $this->model->join('products', 'products.id', '=', 'product_details.product_id')
        ->join('sizes', 'sizes.id', 'product_details.size_id')
        ->join('colors', 'colors.id', 'product_details.color_id')
        ->select('product_details.*', 'products.*', 'sizes.*', 'colors.*')
        ->orderByDesc('products.id')
        ->paginate(15);
    }
}
