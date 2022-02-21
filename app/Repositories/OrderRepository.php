<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Order;

class OrderRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
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

        if (isset($conditions['color_value'])) {
            $conditionsFormated[] = ['color_value', 'like', '%' . $params['color_value'] . '%'];
        }

        $params['sortBy'] = 'id';
        $params['sortType'] =  'asc';
        $this->orderBy($params['sortBy'], $params['sortType']);
        $params['conditions'] = $conditionsFormated;
        $result = $this->searchByParams($params);

        return $result;
    }
}
