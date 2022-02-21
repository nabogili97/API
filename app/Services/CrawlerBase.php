<?php

namespace App\Services;

use Goutte\Client;

abstract class CrawlerBase  implements \App\Services\IMallService
{
    /**
     * crawl html web
     */
    public function scrape($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url, ['proxy' => ramdonProxy()]);
        return $crawler;
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
}
