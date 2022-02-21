<?php


namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Consultation;

class ConsultingRepository extends BaseRepository
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
        return Consultation::class;
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
        if (isset($conditions['email'])) {
            $conditionsFormated[] = ['email', 'like', '%'.$params['email'].'%'];
        }
        if (isset($conditions['phone'])) {
            $conditionsFormated[] = ['phone', 'like', '%'.$params['phone'].'%'];
        }

        if (isset($conditions['status'])) {
            $conditionsFormated[] = ['status' , '=', (int) $conditions['status']];
        }

        if (isset($conditions['sortBy'])) {
            $this->orderBy($params['sortBy'], $params['sortType'] == 1 ? 'desc' : 'asc');
        }

        $params['conditions'] = $conditionsFormated;
        $result = $this->searchByParams($params);


        return $result;
    }
}
