<?php

namespace App\Services;

interface IMallService
{
    /**
     * get category
     *
     * @param string $parentId
     * @return mixed respone
     */
    public function getCategory($parentId);

    /**
     * get top sale in day
     *
     * @param string $page
     * @param integer $categoryId
     * @return mixed respone
     */
    public function getTopSaleInDay($categoryId, $page);

    /**
     * search product
     *
     * @param string $conditions
     * @return mixed respone
     */
    public function searchProduct($conditions);
}
