<?php

namespace App\Services;

use App\Models\Keyword;

use function PHPUnit\Framework\isEmpty;

abstract class MallServiceBase implements \App\Services\IMallService
{
    protected $client;
    
    /**
     * set client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * get category
     *
     * @param string $parentId
     * @return mixed respone
     */
    abstract public function getCategory($parentId);

    /**
     * get top sale in day
     *
     * @param string $page
     * @param integer $categoryId
     * @return mixed respone
     */
    abstract public function getTopSaleInDay($categoryId, $page);

    /**
     * search product
     *
     * @param string $conditions
     * @return mixed respone
     */
    abstract public function searchProduct($conditions);

    /**
     * call api
     * @return mixed respone
     */
    public function callApi($method, $uri, $query)
    {
        $response = $this->client->request($method,$uri, [
            'query' => $query
        ]);
        return json_decode($response->getBody(), true);
    }
    
}
