<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Keyword;

class DashboardRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Keyword::class;
    }

}
