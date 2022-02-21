<?php

namespace App\Services\Alibaba;

use App\Services\ExchangeService;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class AlibabaService extends \App\Services\CrawlerBase
{
    /**
     * get category
     *
     * @param string $parentId
     * @return mixed respone
     */
    public function getCategory($id)
    {
        if (Cache::has('listCategory-alibaba-' . $id)) {
            $listCategoryAlibaba = Cache::get('listCategory-alibaba-' . $id);
            return $listCategoryAlibaba;
        }
        $listCategoryAlibaba = [];
        $url = 'https://japanese.alibaba.com/Products';
        $crawler = parent::scrape($url);
        $crawler->filter('div.item.util-clearfix')->each(
            function (Crawler $node) use (&$listCategoryAlibaba) {
                $node->filter('div.sub-item-wrapper.util-clearfix div.sub-item')
                    ->each(function (Crawler $nod) use (&$listCategoryAlibaba, &$data) {
                        $data1['name'] = $nod->filter('h4 a')->text();
                        $data1['parentId'] = '';
                        $data1['linkCategory'] = $this->convertJapanese($nod->filter('h4 a')->extract(['href'])[0]);
                        $data1['id'] = explode('?', explode('_p', $data1['linkCategory'])[1])[0];

                        $listCategoryLv2Alibaba = [];
                        $nod->filter('div.sub-item-cont-wrapper ul.sub-item-cont.util-clearfix li')
                            ->each(function (Crawler $nd) use (&$listCategoryLv2Alibaba, &$data1) {
                                $data2['name'] = $nd->filter('a')->text();
                                $data2['parent'] = $data1['id'];
                                $data2['linkCategory'] = $this->convertJapanese($nd->filter('a')->extract(['href'])[0]);
                                if (strpos($data2['linkCategory'], 'CID')) {
                                    $getId = explode('ID', $data2['linkCategory']);
                                } elseif (strpos($data2['linkCategory'], 'id')) {
                                    $getId = explode('id', $data2['linkCategory']);
                                } elseif (strpos($data2['linkCategory'], '_p')) {
                                    $getId = explode('_p', $data2['linkCategory']);
                                } else {
                                    $getId = [''];
                                }
                                $data2['id'] = $getId[count($getId) - 1];
                                // $data2['childs'] = $this->getCategoryLv3($data2['linkCategory']);
                                array_push($listCategoryLv2Alibaba, $data2);
                            });
                        $data1['childs']  = $listCategoryLv2Alibaba;
                        array_push($listCategoryAlibaba, $data1);
                    });
            }
        );
        if ($id == 'all') {
            return $listCategoryAlibaba;
        }
        $response = $this->searchCategory($listCategoryAlibaba, $id);
        Cache::put('listCategory-alibaba-' . $id, $response, config('contant.timeSaveCacheCategory'));
        return $response;
    }

    /**
     * Search by categoryId
     *
     * @param string $categoryId
     * @return mixed 
     */
    public function searchCategory($array, $id)
    {
        $results = array();
        if (is_array($array)) {
            if (isset($array['id']) && $array['id'] == $id) {
                $results[] = $array;
                return $results;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, $this->searchCategory($subarray, $id));
            }
        }
        return $results;
    }

    /**
     * 
     */
    public function convertJapanese($linkCategory)
    {
        return str_replace('www', 'japanese', $linkCategory);
    }

    /**
     * 
     */
    // public function getCategoryLv3($linkCategory)
    // {
    //     $listCategoryLv3Alibaba = [];
    //     $crawler = parent::scrape($linkCategory);
    //     $getNode = $crawler->filter('div.cv-you-are-in > div.cv-you-are-in__opiton div.cv-you-are-in__option-childs div.cv-you-are-in__opiton');
    //     if (!empty($getNode)) {
    //         // dd(1);
    //         $getNode->each(function (Crawler $node) use (&$listCategoryLv3Alibaba) {
    //             $data['name'] = $node->filter('a')->text();
    //             $data['linkCategory'] = $this->convertJapanese($node->filter('a')->extract(['href'])[0]);

    //             array_push($listCategoryLv3Alibaba, $data);
    //         });
    //     }
    //         return ($listCategoryLv3Alibaba);
    // }

    /**
     * get top sale in day
     *
     * @param string $page
     * @param integer $categoryId
     * @return mixed respone
     */
    public function getTopSaleInDay($categoryId, $page)
    {
        // $homepage = file_get_html('https://www.example.com/');

        // dd($homepage);
        // https://insights.alibaba.com/openservice/gatewayService?callback=jsonp_1625625082047_9572&ctoken=undefined&_tb_token_=7e581f31815b0&mtop=false&modelId=1056&deliveryId=undefined&cardId=&deliveryBomId=&categoryIds=10&topOfferIds=&pageSize=12&pageNo=5&offerLimit=&appKey=vee8meczxjj3hugfjlmg0t4zh4skimd3&appNameCarry=asinHomePage&appName=asinHomePage&endpoint=pc&pageDeduplicateId=tti7gcujwa4caq7n162562016716713587d0719e01
        //2 https://insights.alibaba.com/openservice/gatewayService?callback=jsonp_1625620168814_99803&ctoken=undefined&_tb_token_=7e581f31815b0&mtop=false&modelId=1056&deliveryId=undefined&cardId=&deliveryBomId=&categoryIds=&topOfferIds=&pageSize=12&pageNo=2&offerLimit=&appKey=vee8meczxjj3hugfjlmg0t4zh4skimd3&appNameCarry=asinHomePage&appName=asinHomePage&endpoint=pc&pageDeduplicateId=tti7gcujwa4caq7n162561986852913b0b22826a3d
        //3 https://insights.alibaba.com/openservice/gatewayService?callback=jsonp_1625620169469_8706&ctoken=undefined&_tb_token_=7e581f31815b0&mtop=false&modelId=1056&deliveryId=undefined&cardId=&deliveryBomId=&categoryIds=&topOfferIds=&pageSize=12&pageNo=3&offerLimit=&appKey=vee8meczxjj3hugfjlmg0t4zh4skimd3&appNameCarry=asinHomePage&appName=asinHomePage&endpoint=pc&pageDeduplicateId=tti7gcujwa4caq7n162561986852913b0b22826a3d
        //4 https://insights.alibaba.com/openservice/gatewayService?callback=jsonp_1625620169878_58881&ctoken=undefined&_tb_token_=7e581f31815b0&mtop=false&modelId=1056&deliveryId=undefined&cardId=&deliveryBomId=&categoryIds=&topOfferIds=&pageSize=12&pageNo=4&offerLimit=&appKey=vee8meczxjj3hugfjlmg0t4zh4skimd3&appNameCarry=asinHomePage&appName=asinHomePage&endpoint=pc&pageDeduplicateId=tti7gcujwa4caq7n162561986852913b0b22826a3d
        //5 https://insights.alibaba.com/openservice/gatewayService?callback=jsonp_1625620176508_96851&ctoken=undefined&_tb_token_=7e581f31815b0&mtop=false&modelId=1056&deliveryId=undefined&cardId=&deliveryBomId=&categoryIds=&topOfferIds=&pageSize=12&pageNo=5&offerLimit=&appKey=vee8meczxjj3hugfjlmg0t4zh4skimd3&appNameCarry=asinHomePage&appName=asinHomePage&endpoint=pc&pageDeduplicateId=tti7gcujwa4caq7n162561986852913b0b22826a3d
        // $url = 'https://insights.alibaba.com/openservice/gatewayService?callback=jsonp_1625570535796_59924&ctoken=undefined&_tb_token_=ff1b335e7a5e7&mtop=false&modelId=1056&deliveryId=undefined&cardId=&deliveryBomId=&categoryIds=&topOfferIds=&pageSize=12&pageNo=1&offerLimit=&appKey=vee8meczxjj3hugfjlmg0t4zh4skimd3&appNameCarry=asinHomePage&appName=asinHomePage&endpoint=pc&pageDeduplicateId=tti7gcujwa4caq7n1625570278734e43666b1fd0ee';

        // https://insights.alibaba.com/openservice/gatewayService?callback=jsonp_1625716285533_71856&ctoken=vgwm3l1wn79r&_tb_token_=5aede3ed87565&mtop=false&modelId=1238&deliveryId=2281002_902056807_STOCK_25_94664499&cardId=&deliveryBomId=&categoryIds=&topOfferIds=&pageSize=12&pageNo=1&offerLimit=&appKey=vee8meczxjj3hugfjlmg0t4zh4skimd3&appNameCarry=asinHomePage&appName=asinHomePage&endpoint=pc&pageDeduplicateId=tti7gcujwa4caq7n16257162792892e357db9271d0&n=2000&resId=902056807&modelType=1&isIndiv=true

        if (Cache::has('listProduct-alibaba-' . $categoryId . '-' . $page)) {
            $listProductAlibaba = Cache::get('listProduct-alibaba-' . $categoryId . '-' . $page);
            return $listProductAlibaba;
        }
        $client = new Client();
        $response = $client->request('GET', config('contant.alibaba.base_uri'), [
            'query' => [
                'callback' => config('contant.alibaba.callback'),
                'ctoken'  => config('contant.alibaba.ctoken'),
                '_tb_token_' => config('contant.alibaba._tb_token_'),
                'mtop' => config('contant.alibaba.mtop'),
                'modelId' => config('contant.alibaba.modelId'),
                'deliveryId' => config('contant.alibaba.deliveryId'),
                'cardId' => config('contant.alibaba.cardId'),
                'deliveryBomId' => config('contant.alibaba.deliveryBomId'),
                'categoryIds' => $categoryId,
                'topOfferIds' => config('contant.alibaba.topOfferIds'),
                'appKey' => config('contant.alibaba.appKey'),
                'appNameCarry' => config('contant.alibaba.appNameCarry'),
                'appName' => config('contant.alibaba.appName'),
                'endpoint' => config('contant.alibaba.endpoint'),
                'pageDeduplicateId' => config('contant.alibaba.pageDeduplicateId'),
                'pageSize' => config('contant.alibaba.productOfPage'),
                'cardType' => config('contant.alibaba.cardType'),
                'pageNo' => $page
            ]
        ]);
        $result = (str_replace('})', '}', $response->getBody()));
        $xuly_result = str_replace('jsonp_1625715295285_56103(', '', $result);
        try {
            $response = json_decode($xuly_result, true)['data']['list'];
        } catch (\Throwable $th) {
            $response = [];
        }
        if ($response == []) {
            $url = $this->getCategory($categoryId)[0]['linkCategory'];
            $listProductByCategoryAlibaba = [];
            for ($i = 1; $i <= 13; $i++) {
                $crawler = parent::scrape($url . '?page=' . $i);
                $crawler->filter('div.organic-gallery-offer-outter.J-offer-wrapper')->each(
                    function (Crawler $node) use (&$listProductByCategoryAlibaba) {
                        $data['detail'] = $node->filter('div > a.organic-gallery-offer__img-section')->extract(['href'])[0];
                        $data['image'] = $node->filter('div a div.seb-img-switcher.J-img-switcher div.seb-img-switcher__imgs')->extract(['data-image'])[0];
                        $data['subject'] = $node->filter('div.organic-gallery-offer-section__title>h4')->text();
                        array_push($listProductByCategoryAlibaba, $data);
                    }
                );
            }
            $response = $listProductByCategoryAlibaba;
        }
        if (count($response) > 100) {
            $result = array_slice($response, 0, 100);
            Cache::put('listProduct-alibaba-' . $categoryId . '-' . $page, $result, config('contant.timeSaveTopSaleMercari'));
            return $result;
        }
        Cache::put('listProduct-alibaba-' . $categoryId . '-' . $page, $response, config('contant.timeSaveTopSaleMercari'));
        return $response;
    }

    public function searchProduct2($conditions)
    {
        $client = new Client();
        $exchangeService = new ExchangeService();
        $exchangRateUSDToYen = $exchangeService->getExchangeRateUSDToYen();
        $keyword = $conditions['keyword'];
        $minPrice = $conditions['minPrice'] / $exchangRateUSDToYen;
        $maxPrice = $conditions['maxPrice'] / $exchangRateUSDToYen;
        $response = $client->request('GET',"https://open-s.alibaba.com/openservice/galleryProductOfferResultViewService?
        appName=magellan&appKey=a5m1ismomeptugvfmkkjnwwqnwyrhpb1&language=japanese&fromTnginx=Y&IndexArea=product_en
        &tab=&CatId=&viewtype=L&SearchText=.$keyword
        &fsb=y&waterfallCtrPageId=57218cb15b3e4c59a1b1e8535327c096&waterfallReqCount=1
        &asyncLoadIndex=2&asyncLoad=true&callback=__jp5&pageSize=200
        &pricef=$minPrice&pricet=$maxPrice");
       
        // $response = $client->request('GET',$uri, 
        // [
        //     'appName' => 'magellan',
        //     'appKey' => 'a5m1ismomeptugvfmkkjnwwqnwyrhpb1',
        //     'language' => 'japanese',
        //     'fromTnginx' => 'Y',
        //     'IndexArea' => 'product_en',
        //     'tab' => '',
        //     'CatId' => '',
        //     'viewtype' => 'L',
        //     'SearchText' => $keyword,
        //     'fsb' => 'y',
        //     'waterfallCtrPageId' => '57218cb15b3e4c59a1b1e8535327c096',
        //     'waterfallReqCount' => 1,
        //     'asyncLoadIndex' => 2,
        //     'asyncLoad' => 'true',
        //     'callback' => '__jp5',
        //     'pageSize' => 250
        // ]);
        $response = $response->getBody();
        $response = str_replace('__jp5(', '',$response);
        $response = str_replace(');', '', $response);
        return json_decode($response);
    }

    /**
     * search product
     *
     * @param string $conditions
     * @return mixed respone
     */
    public function searchProduct($conditions)
    {
        
        $listProductAlibaba=[];
        $exchangeService = new ExchangeService();
        $exchangRateUSDToYen = $exchangeService->getExchangeRateUSDToYen();
        $searchText = substr(handleKeyword(str_replace(' ','+',$conditions['keyword'])), 0, 50);
        if ($conditions['minPrice']) {
            $searchMinPrice = round($conditions['minPrice'] /  $exchangRateUSDToYen, 6);
        }else {
            $searchMinPrice = null;
        }
        if ($conditions['maxPrice'] && $conditions['maxPrice'] >= $conditions['minPrice'] ) {
            $searchMaxPrice = round($conditions['maxPrice'] /  $exchangRateUSDToYen, 6);
        }else {
            $searchMaxPrice = null;
        }
        $url = 'https://japanese.alibaba.com/trade/search?IndexArea=product_en&CatId=&f0=y&SearchScene=&viewtype=G&SearchText=' . $searchText . '&pricef=' . $searchMinPrice . '&pricet=' . $searchMaxPrice;
        for ($i = 1; $i <= 3; $i++) {
            $crawler = parent::scrape($url . '&page=' . $i);
            $crawler->filter('div.organic-gallery-offer-outter.J-offer-wrapper')->each(
                function (Crawler $node) use (&$listProductAlibaba, $exchangRateUSDToYen) {
                try {
                    $tag = 'div.organic-offer-wrapper.img-switcher-parent';
                    $data['link'] = $node->filter($tag.' a')->extract(['href'])[0];
                    $data['linkImg'] = $node->filter($tag.' a div.seb-img-switcher div.seb-img-switcher__imgs')->extract(['data-image'])[0];
                    $data['name'] = $node->filter('h4.elements-title-normal__outter')->extract(['title'])[0];
                    $data['seller'] = $node->filter('a.organic-gallery-offer__seller-company')->extract(['title'])[0];
                    $data['seller_link'] = $node->filter('a.organic-gallery-offer__seller-company')->extract(['href'])[0];
                    $test = $node->filter('p.elements-offer-price-normal.medium')->extract(['title'])[0];
                    if (!empty($test)) {
                        $price = str_replace(['$', '¥'], '', explode('-', $test)[0]);
                        if (strpos($test, '$') !== false) {
                            $data['price'] = (round((float)$price *  $exchangRateUSDToYen, 1));
                        }
                        array_push($listProductAlibaba, $data);
                    }
                }catch (\Throwable $th) {
                        $data[] = null;
                    }
                }
            );
        }
        if (count($listProductAlibaba) > 100) {
            array_slice($listProductAlibaba, 0, 100);
            return array_splice($listProductAlibaba, 1);
        }
        return array_splice($listProductAlibaba, 1);
    }
}
