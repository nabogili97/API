<?php

namespace App\Services\Rakunten;

use App\Services\IMallService;

interface IRakuntenService extends IMallService
{
    /**
     * search product
     *
     * @param string $conditions
     * @return mixed respone
     */
    public function getLinkReviewProduct($conditions);
}
