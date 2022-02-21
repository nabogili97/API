<?php


namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Log;

class LogRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Log::class;
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

        if (isset($conditions['status'])) {
            $conditionsFormated[] = ['status' , '=', (int) $conditions['status']];
        }

        if (isset($conditions['thing'])) {
            $conditionsFormated[] = ['thing_id' , '=', (int) $conditions['thing']];
        }

        if (isset($conditions['zone'])) {
            $conditionsFormated[] = ['zone_id' , '=', (int) $conditions['zone']];
        }
        
        if (isset($conditions['group'])) {
            $conditionsFormated[] = ['group_id' , '=', (int) $conditions['group']];
        }

        $params['conditions'] = $conditionsFormated;
        $result = $this->searchByParams($params);

        return $result;
    }   
}