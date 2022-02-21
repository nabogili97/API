<?php

namespace App\Services\Rakunten;

use App\Services\MallServiceBase;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class RakuntenService extends MallServiceBase implements IRakuntenService
{
    public function __construct()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('contant.rakuten.base_uri'),
            // You can set any number of default request options.
            'timeout' => config('contant.timeout'),
        ]);
        parent::setClient($client);
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
        $uri = '/services/api/IchibaGenre/Search/20140222';
        $query = [
            'applicationId' => config('contant.rakuten.appId'),
            'format' => 'json',
            'genreId' => $parentId
        ];
        if (Cache::has("listCategory-rakuten-'.$parentId")) {
            $listCategoryRakuten = Cache::get('listCategory-rakuten-' . $parentId);
            return $listCategoryRakuten;
        }

        $response = parent::callApi($method, $uri, $query);
        Cache::put('listCategory-rakuten-' . $parentId, $response, config('contant.timeSaveCacheCategory'));
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
        if (Cache::has('getTopSaleInDayOfRakuten-' . $categoryId . '-' . $page)) {
            return Cache::get('getTopSaleInDayOfRakuten-' . $categoryId . '-' . $page);
        }
        $method = 'GET';
        $uri = '/services/api/IchibaItem/Ranking/20170628';
        $query = [
            'applicationId' => config('contant.rakuten.appId'),
            'genreId' => $categoryId,
            'format' => 'json',
            'page' => $page
        ];
        $result = parent::callApi($method, $uri, $query);
        Cache::put('getTopSaleInDayOfRakuten-' . $categoryId . '-' . $page, $result, config('contant.timeCacheSaleInDate'));
        return Cache::get('getTopSaleInDayOfRakuten-' . $categoryId . '-' . $page);
    }

    /**
     * search product
     *
     * @param string $conditions
     * @return mixed respone
     */
    public function searchProduct($param)
    {

        $method = 'GET';
        $uri = '/services/api/IchibaItem/Search/20170706';
        $keyword = trim($param['keyword']);
        $keyword =handleKeyword($keyword);
        $freeShipping = 0;
        $checkProductAvailability = 0;
        if ($param['freeShipping']) {
            $freeShipping = 1;
        }
        if ($param['checkProductAvailability'])
            $checkProductAvailability = 1;
        $query = [
            'applicationId' => config('contant.rakuten.appId'),
            'format' => 'json',
            'keyword' => $keyword,
            'minPrice' => $param['minPrice'],
            'maxPrice' =>  $param['maxPrice'],
            'postageFlag' => $freeShipping,
            'availability' => $checkProductAvailability,
            'postageFlag' => $param['shipping']
        ];
        return parent::callApi($method, $uri, $query);
    }

    /**
     * get link review
     *
     * @param string $jancode
     * @return mixed respone
     */
    public function getLinkReviewProduct($param)
    {
        $method = 'GET';
        $uri = '/services/api/Product/Search/20170426';
        $query = [
            'keyword' => $param['jancode'],
            'applicationId' => '1082087539982223109'
        ];
        return parent::callApi($method, $uri, $query);
    }
}
