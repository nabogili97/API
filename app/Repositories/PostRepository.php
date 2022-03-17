<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Post;

class PostRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
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

        if (isset($conditions['title'])) {
            $conditionsFormated[] = ['title', 'like', '%' . $params['title'] . '%'];
        }

        if (isset($conditions['status'])) {
            $conditionsFormated[] = ['status', '=', (int) $conditions['status']];
        }
        $params['sortBy'] = 'id';
        $params['sortType'] =  'desc';
        $this->orderBy($params['sortBy'], $params['sortType']);
        $params['limit'] = 5;
        $params['conditions'] = $conditionsFormated;
        $result = $this->searchByParams($params);

        return $result;
    }
}
