<?php

namespace App\Services\Mercari;

use Exception;
use PharIo\Manifest\Url;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Cache;

use function PHPUnit\Framework\isEmpty;

class MercariService extends \App\Services\CrawlerBase
{

    private $listCategoryLeve2 = [];
    private $listCategory = [];

    private $listNameCategoryparents = [];
    private $lisIdCategoryparents = [];

    private $index = 0;


    /**
     * get category
     *
     * @param string $parentId
     * @return mixed respone
     */
    public function getCategory($parentId)
    {
        if (Cache::has("listCategory-mercari-'.$parentId")) {
            $listCategoryMercari = Cache::get('listCategory-mercari-' . $parentId);
            return $listCategoryMercari;
        }

        $url = 'https://www.mercari.com/jp/category/';
        $crawler = parent::scrape($url);
        $crawler->filter('div > div > div > div > div > div > div > a')->each(function (Crawler $node) {
            $id = explode('/', $node->extract(['href'])[0])[3];
            array_push($this->lisIdCategoryparents, $id);
        });
        $crawler->filter('h2')->each(function (Crawler $node) {
            array_push($this->listNameCategoryparents, $node->text());
        });

        $crawler->filter('h2+div')->each(
            function (Crawler $node) {

                $listNameCategoryLeve2 = [];
                $node->filter('div > h3')->each(function (Crawler $node) use (&$listNameCategoryLeve2) {
                    array_push($listNameCategoryLeve2, $node->filter('h3')->text());
                });

                $index = 0;

                foreach ($listNameCategoryLeve2 as $nameCategoryLeve2) {

                    $categoryLeve2 = [];
                    $node->filter('div ul')->each(function (Crawler $node) use (&$categoryLeve2) {

                        $listCategoryLeve3 = [];
                        $node->filter('li a')->each(function (Crawler $node) use (&$listCategoryLeve3) {
                            $categoryLeve3 = [
                                'id' =>  explode('/', $node->extract(['href'])[0])[3],
                                'name' => $node->text(),
                                'children' => []
                            ];
                            array_push($listCategoryLeve3, $categoryLeve3);
                        });
                        array_push($categoryLeve2, $listCategoryLeve3);
                    });
                    $categoryLeve2;
                    $idLeve2 = $categoryLeve2[$index][0]['id'];
                    array_splice($categoryLeve2[$index], 0, 1);
                    array_push(
                        $this->listCategoryLeve2,
                        [
                            'id' =>  $idLeve2,
                            'name' => $nameCategoryLeve2,
                            'children' => $categoryLeve2[$index]
                        ]
                    );

                    $index++;
                }
                array_push(
                    $this->listCategory,
                    [
                        'id' =>  $this->lisIdCategoryparents[$this->index],
                        'name' =>  $this->listNameCategoryparents[$this->index],
                        'children' => $this->listCategoryLeve2
                    ]
                );

                $this->index++;
            }
        );

        $length = 0;
        for ($i = 0; $i < sizeof($this->listCategory) - 1; $i++) {
            $length += sizeof($this->listCategory[$i]['children']);
            array_splice($this->listCategory[$i + 1]['children'], 0, sizeof($this->listCategory[$i]['children']));
        }

        $response = $this->getNodeCategory($parentId);
        if ($response === null) {
            return [];
        }
        Cache::put('listCategory-rakuten-' . $parentId, $response, config('contant.timeSaveCacheCategory'));
        return $response;
    }

    /**
     * get node category by parentId
     * 
     * @param int $parentId
     * @return mixed $category
     */
    private function getNodeCategory($parentId)
    {
        if ($parentId === null) {
            return $this->listCategory;
        }

        foreach ($this->listCategory as $item) {
            if ($item['id'] === $parentId) {
                return $item['children'];
            }
            foreach ($item['children'] as $categoryLeve2) {
                //dd(categoryLeve2);
                if ($categoryLeve2['id'] === $parentId) {
                    return $categoryLeve2['children'];
                }
                foreach ($categoryLeve2['children'] as $categoryLeve3) {
                    if ($categoryLeve3['id'] === $parentId) {
                        return [0 => $categoryLeve3];
                    }
                }
            }
        }
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
        if (Cache::has('getTopSaleInDayOfMercari-'. $categoryId)) {
            return Cache::get('getTopSaleInDayOfMercari-'. $categoryId);
        }
        $url = 'https://www.mercari.com/jp/category/' . $categoryId;
        $crawler = parent::scrape($url);
        $listProduct = [];
        $crawler->filter('.sc-htpNat.hYahgh > li > div')->each(function (Crawler $node) use (&$listProduct) {
            $productUrl = 'https://www.mercari.com' . $node->filter('a')->extract(['href'])[0];
            $productName = $node->filter('a > figure > figcaption > span')->text();
            $imageUrl = $node->filter('a > figure > div > img')->extract(['src'])[0];
            $productPrice  = str_replace('¥', '', $node->filter('a > figure > div > span')->text());
            $product = [
                'productName' => $productName,
                'imageUrl' => $imageUrl,
                'price' => $productPrice,
                'productUrl' => $productUrl
            ];
            array_push($listProduct, $product);
        });
        $listProduct = array_slice($listProduct, 0, 100);
        Cache::put('getTopSaleInDayOfMercari-' . $categoryId , $listProduct, 300);
        return $listProduct;
    }

    /**
     * get top sale page index
     * 
     * @param string $page
     * @param integer $categoryId
     * @return mixed respone
     */

    public function getTopSalePageIndex()
    {
        if (Cache::has('getTopSaleInDayOfMercari')) {
            return Cache::get('getTopSaleInDayOfMercari');
        }

        $arrCategory = [1, 2, 7, 1328];
        $listProduct = [];
        foreach ($arrCategory as $item) {
            $listProduct = array_merge($listProduct, array_slice($this->getTopSaleInDay($item, 0), 0, 25));
        }
        Cache::put('getTopSaleInDayOfMercari', $listProduct, config('contant.timeSaveTopSaleMercari'));
        return $listProduct;
    }
    /**
     * search product
     *
     * @param string $conditions
     * @return mixed respone
     */
    public function searchProduct($conditions)
    {
         
        $listProduct = [];
        $urlConditions = '';
        if ($conditions['price_min'] != null) {
            $urlConditions = $urlConditions . '&price_min=' . $conditions['price_min'];
        }
        if ($conditions['price_max'] != null) {
            $urlConditions = $urlConditions . '&price_max=' . $conditions['price_max'];
        }
        if ($conditions['shipping_payer_id'] === 1) {
            $urlConditions = $urlConditions . '&shipping_payer_id=' . $conditions['shipping_payer_id'];
        }
        $url = 'https://www.mercari.com/jp/search/?keyword=' . $conditions['keyword'] . $urlConditions;
        $crawler = parent::scrape($url);

        // check searcg result empty
        if (empty($crawler->filter('.search-result-head + div')->extract(['class'])) ) {
           return [];
        }

        $crawler->filter('div.items-box-content.clearfix > section')->each(function (Crawler $node) use (&$listProduct) {
            $productUrl = 'https://www.mercari.com' . $node->filter('a')->extract(['href'])[0];
            $imageUrl = $node->filter('a figure img')->extract(['data-src'])[0];
            $productName = $node->filter('a div h3')->text();
            $productPrice  = str_replace('¥', '', $node->filter('a div div div')->text());
            $product = [
                'productName' => $productName,
                'imageUrl' => $imageUrl,
                'price' => $productPrice,
                'productUrl' => $productUrl
            ];
            array_push($listProduct, $product);
        });
        return $listProduct;
    }
}
