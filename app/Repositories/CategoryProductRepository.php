<?php


namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\CategoryProduct;

class CategoryProductRepository extends BaseRepository
{   


        protected $fieldSearchable = [];


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryProduct::class;
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

        if (isset($conditions['name'])) {
            $conditionsFormated[] = ['name', 'like', '%'.$params['name'].'%'];
        }

        if (isset($conditions['status'])) {
            $conditionsFormated[] = ['status' , '=', (int) $conditions['status']];
        }


        $params['sortBy'] = 'position';
        $params['sortType'] =  'asc';
        $params['limit'] = 10;
        $this->orderBy($params['sortBy'], $params['sortType']);
        $params['conditions'] = $conditionsFormated;
        $result = $this->searchByParams($params);

        return $result;
    }
}
