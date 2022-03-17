<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Payment;

class PaymentRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Payment::class;
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
            $conditionsFormated[] = ['name', 'like', '%' . $params['name'] . '%'];
        }

        if (isset($conditions['phone'])) {
            $conditionsFormated[] = ['phone', 'like', '%' . $params['phone'] . '%'];
        }

        $params['sortBy'] = 'id';
        $params['sortType'] =  'asc';
        $this->orderBy($params['sortBy'], $params['sortType']);
        $params['conditions'] = $conditionsFormated;
        $result = $this->searchByParams($params);

        return $result;
    }
}
