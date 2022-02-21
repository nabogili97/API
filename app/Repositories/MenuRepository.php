<?php


namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Menu;

class MenuRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
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
        if (isset($conditions['description'])) {
            $conditionsFormated[] = ['description', 'like', '%'.$params['description'].'%'];
        }

        if (isset($conditions['status'])) {
            $conditionsFormated[] = ['status' , '=', (int) $conditions['status']];
        }
        $params['sortBy'] = 'position';
        $params['sortType'] =  'asc';
        $this->orderBy($params['sortBy'], $params['sortType']);
        $params['conditions'] = $conditionsFormated;
        $result = $this->searchByParams($params);

        return $result;
    }
}
