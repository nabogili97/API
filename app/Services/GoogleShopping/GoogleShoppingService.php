<?php

namespace  App\Services\GoogleShopping;
use Symfony\Component\DomCrawler\Crawler;

class GoogleShoppingService extends \App\Services\CrawlerBase
{
    /**
     * get category
     *
     * @param string $parentId
     * @return mixed respone
     */
    public function getCategory($parentId)
    {
        $url = '';
        $crawler = parent::scrape($url);
        $crawler->filter('ul.homeproduct li.item')->each(
            function (Crawler $node) {
                $name = $node->filter('h3')->text();

                $price = $node->filter('.price strong')->text();

                $wholeStar = $node->filter('.icontgdd-ystar')->count();
                $halfStar = $node->filter('.icontgdd-hstar')->count();
                $rate = $wholeStar + 0.5 * $halfStar;
            }
        );
    }

    /**
     * get top sale in day
     *
     * @param string $page
     * @param integer $categoryId
     * @return mixed respone
     */
    public function getTopSaleInDay($categoryId, $page)
    {
        $url = '';
        $crawler = parent::scrape($url);
    }

    /**
     * search product
     *
     * @param string $conditions
     * @return mixed respone
     */
    public function searchProduct($conditions)
    {
        $url = '';
        $crawler = parent::scrape($url);
    }
}
