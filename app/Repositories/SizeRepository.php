<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Size;

class SizeRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Size::class;
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
}
