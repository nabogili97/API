<?php

namespace App\Services\YahooShopping;

use App\Services\MallServiceBase;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use App\Repositories\KeywordRepository;

class YahooService extends MallServiceBase implements IYahooService
{    
    public function __construct()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('contant.yahooshopping.base_uri'),
            // You can set any number of default request options.
            'timeout' =>  config('contant.timeout'),
        ]);
        parent::setClient($client);
    }
    
    /**
     * get category
     *
     * @param string $parentId
     * @return mixed respone
     */
    public function getClient()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('contant.yahooshopping.base_uri'),
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
        return $client;
    }

    /**
     * get category
     *
     * @param string $parentId
     * @return mixed respone
     */
    public function getCategory($parentId)
    {
        $method = 'GET';
        $uri = 'ShoppingWebService/V1/json/categorySearch';
        $query = [
            'appId' => config('contant.yahooshopping.appId'),
            'category_id' => $parentId
        ];
        if(Cache::has('listCategory-yahoo-'.$parentId))
        {
            $listCategoryYahoo = Cache::get('listCategory-yahoo-'.$parentId);
            return $listCategoryYahoo;
        }
        $response = parent::callApi($method, $uri, $query );
        Cache::put('listCategory-yahoo-'.$parentId, $response, config('contant.timeSaveCacheCategory'));
        return $response;
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
        if (Cache::has('getTopSaleInDayOfYahoo-'.$categoryId.'-'.$page)) {
            return Cache::get('getTopSaleInDayOfYahoo-'.$categoryId.'-'.$page);
        }
        $method = 'GET';
        $uri = 'ShoppingWebService/V2/categoryRanking';
        $query = [
            'appId' => config('contant.yahooshopping.appId'),
            'period' => 'daily',
            'category_id' => $categoryId,
            'offset' => $page
        ];
        $result = parent::callApi($method, $uri, $query );
        Cache::put('getTopSaleInDayOfYahoo-'.$categoryId.'-'.$page, $result, config('contant.timeCacheSaleInDate'));
        return Cache::get('getTopSaleInDayOfYahoo-'.$categoryId.'-'.$page);
    }

    /**
     * search product
     *
     * @param string $conditions
     * @return mixed respone
     */
    public function searchProduct($param)
    {
        $keyword = trim($param['query']);
       $keyword =str_replace(' - ',' ',$keyword);
       $keyword = handleKeyword( $keyword);
       $saveKeyword = $param['saveKeyword'];
        $method = 'GET';
        $uri = 'ShoppingWebService/V3/itemSearch';
        $query = [
            'appId' => config('contant.yahooshopping.appId'),
            'query' => $keyword,
            'jan_code' => $param['jan_code'],
            'results' => 100,
            'price_from' => $param['minPrice'],
            'price_to' => $param['maxPrice'],
            'shipping' => $param['shipping'],
            'sort' => $param['sort'],
            'in_stock' => $param['in_stock']
        ];
        if($saveKeyword === '1')
        {
            $keywordRepository = new KeywordRepository();
            $keywordRepository->storeKeyword($keyword);
        }
        
        return parent::callApi($method, $uri, $query );
    }
}
