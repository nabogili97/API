<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Comment;

class CommentRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
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

        if (isset($conditions['comment'])) {
            $conditionsFormated[] = ['comment', 'like', '%' . $params['comment'] . '%'];
        }

        if (isset($conditions['user_id'])) {
            $conditionsFormated[] = ['user_id', 'like', '%' . $params['user_id'] . '%'];
        }


        if (isset($conditions['product_id'])) {
            $conditionsFormated[] = ['product_id', 'like', '%' . $params['product_id'] . '%'];
        }


        $params['sortBy'] = 'id';
        $params['sortType'] =  'desc';
        $this->orderBy($params['sortBy'], $params['sortType']);
        $params['limit'] = 15;
        $params['conditions'] = $conditionsFormated;
        $result = $this->searchByParams($params);

        return $result;
    }
}
