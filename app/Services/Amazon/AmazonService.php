<?php

namespace App\Services\Amazon;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use App\Services\MallServiceBase;
use App\Services\Amazon\IAmazonService;

use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\GetBrowseNodesRequest;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\GetBrowseNodesResource;

use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\api\DefaultApi;
use Amazon\ProductAdvertisingAPI\v1\ApiException;
use Amazon\ProductAdvertisingAPI\v1\Configuration;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\SearchItemsRequest;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\SearchItemsResource;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\PartnerType;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\GetItemsRequest;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\GetItemsResource;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\ProductAdvertisingAPIClientException;




// require_once(__DIR__ . '/vendor/autoload.php'); // change path as needed

class AmazonService extends MallServiceBase implements IAmazonService
{
    public function __construct()
    {
    }

    /**
     * Returns the array of Browse Nodes mapped to Browse Node id
     *
     * @param array $browseNodes Browse nodes value.
     * @return array of \Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\BrowseNode mapped to Browse Node id.
     */

    /**
     * get category
     *
     * @param string $parentId
     * @return mixed response
     *
     * @throws \Exception
     */
    public function getCategory($parentId)
    {

        $response = fakerDataCategoryAmazon();
        return $response;
        $config = new Configuration();
        /*
     * Add your credentials
     */
        # Please add your access key here
        $config->setAccessKey(config('contant.amazon.us.access_key'));
        # Please add your secret key here
        $config->setSecretKey(config('contant.amazon.us.secret_key'));

        # Please add your partner tag (store/tracking id) here
        $partnerTag = config('contant.amazon.us.partner_tag');

        /*
     * PAAPI host and region to which you want to send request
     * For more details refer:
     * https://webservices.amazon.com/paapi5/documentation/common-request-parameters.html#host-and-region
     */
        $config->setHost('webservices.amazon.com');
        $config->setRegion('us-east-1');

        $apiInstance = new DefaultApi(
            /*
     * If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
     * This is optional, `GuzzleHttp\Client` will be used as default.
     */
            new Client(),
            $config
        );

        # Request initialization

        # Specify browseNode id(s)
        $browseNodeIds = $parentId;

        /*
     * Choose resources you want from GetItemsResource enum
     * For more details,
     * refer: https://webservices.amazon.com/paapi5/documentation/getbrowsenodes.html#resources-parameter
     */
        $resources = [
            GetBrowseNodesResource::ANCESTOR,
            GetBrowseNodesResource::CHILDREN
        ];

        # Forming the request
        $getBrowseNodesRequest = new GetBrowseNodesRequest();
        $getBrowseNodesRequest->setBrowseNodeIds($browseNodeIds);
        $getBrowseNodesRequest->setPartnerTag($partnerTag);
        $getBrowseNodesRequest->setPartnerType(PartnerType::ASSOCIATES);
        $getBrowseNodesRequest->setResources($resources);

        # Validating request
        $invalidPropertyList = $getBrowseNodesRequest->listInvalidProperties();
        $length = count($invalidPropertyList);
        if ($length > 0) {
            return null;
        }

        # Sending the request
        try {
            $promise = $apiInstance->getBrowseNodesAsync($getBrowseNodesRequest);
            $response = $promise->wait();
            $promise->then(
                function ($response) {
                    return $response;
                },
                function (\Exception $exception) {
                    throw $exception;
                }
            );

            return $response;
        } catch (\Exception $exception) {
            throw $exception;
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
        // if (Cache::has('getTopSaleInDayOfYahoo-' . $categoryId . '-' . $page)) {
        //     return Cache::get('getTopSaleInDayOfYahoo-' . $categoryId . '-' . $page);
        // }
        // $method = 'GET';
        // $uri = 'ShoppingWebService/V2/categoryRanking';
        // $query = [
        //     'appId' => config('contant.yahooshopping.appId'),
        //     'period' => 'daily',
        //     'category_id' => $categoryId,
        //     'offset' => $page
        // ];
        // $result = parent::callApi($method, $uri, $query);
        // Cache::put('getTopSaleInDayOfYahoo-' . $categoryId . '-' . $page, $result, config('contant.timeCacheSaleInDate'));
        // return Cache::get('getTopSaleInDayOfYahoo-' . $categoryId . '-' . $page);

        $response = fakerDataSellRankingAmazon();
        return $response;

        $config = new Configuration();

        /*
         * Add your credentials
         * Please add your access key here
         */
        $config->setAccessKey(config('contant.amazon.us.access_key'));
        # Please add your secret key here
        $config->setSecretKey(config('contant.amazon.us.secret_key'));

        # Please add your partner tag (store/tracking id) here
        $partnerTag = config('contant.amazon.us.partner_tag');;

        /*
         * PAAPI host and region to which you want to send request
         * For more details refer: https://webservices.amazon.com/paapi5/documentation/common-request-parameters.html#host-and-region
         */
        $config->setHost('webservices.amazon.com');
        $config->setRegion('us-east-1');

        $apiInstance = new DefaultApi(
            /*
         * If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
         * This is optional, `GuzzleHttp\Client` will be used as default.
         */
            new Client(),
            $config
        );

        # Request initialization

        # Choose item id(s)
        $itemIds = array("059035342X", "B00X4WHP55", "1401263119");

        /*
         * Choose resources you want from GetItemsResource enum
         * For more details, refer: https://webservices.amazon.com/paapi5/documentation/get-items.html#resources-parameter
         */
        $resources = array(
            GetItemsResource::ITEM_INFOTITLE,
            GetItemsResource::OFFERSLISTINGSPRICE
        );

        # Forming the request
        $getItemsRequest = new GetItemsRequest();
        $getItemsRequest->setItemIds($itemIds);
        $getItemsRequest->setPartnerTag($partnerTag);
        $getItemsRequest->setPartnerType(PartnerType::ASSOCIATES);
        $getItemsRequest->setResources($resources);

        # Validating request
        $invalidPropertyList = $getItemsRequest->listInvalidProperties();
        $length = count($invalidPropertyList);
        if ($length > 0) {
            echo "Error forming the request", PHP_EOL;
            foreach ($invalidPropertyList as $invalidProperty) {
                echo $invalidProperty, PHP_EOL;
            }
            return null;
        }

        # Sending the request
        try {
            $getItemsResponse = $apiInstance->getItems($getItemsRequest);
            # Parsing the response
            return $getItemsResponse;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }


    /**
     * search product
     *
     * @param string $conditions
     * @return mixed respone
     */
    public function searchProduct($param)
    {
        $keyword = trim($param['keyword']);
        $jan_code = $param['jan_code'];
        $results = 100;
        $price_from = $param['minPrice'];
        $price_to = $param['maxPrice'];
        $shipping = $param['shipping'];
        $sort = '+price';
        $in_stock = $param['in_stock'];
        $marketplace = $param['marketplace'];

        // if ($marketplace === 'us')
        //         return 1;
        $response = fakerDataSearchAmazon();
        return $response;


        $config = new Configuration();

        /*
 * Add your credentials
 * Please add your access key here
 */
        if ($marketplace === 'us') {
            $config->setAccessKey(config('contant.amazon.us.AccessKey'));
            # Please add your secret key here
            $config->setSecretKey(config('contant.amazon.us.SecretKey'));

            # Please add your partner tag (store/tracking id) here
            $partnerTag = config('contant.amazon.us.PartnerTag');

            /*
 * PAAPI host and region to which you want to send request
 * For more details refer: https://webservices.amazon.com/paapi5/documentation/common-request-parameters.html#host-and-region
 */
            $config->setHost(config('contant.amazon.us.base_uri'));
            $config->setRegion(config('contant.amazon.us.Region'));
        }
        else
        {
            $config->setAccessKey(config('contant.amazon.jp.AccessKey'));
            # Please add your secret key here
            $config->setSecretKey(config('contant.amazon.jp.SecretKey'));

            # Please add your partner tag (store/tracking id) here
            $partnerTag = config('contant.amazon.jp.PartnerTag');

            $config->setHost(config('contant.amazon.jp.base_uri'));
            $config->setRegion(config('contant.amazon.jp.Region'));
        }
        $apiInstance = new DefaultApi(
            /*
* If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
* This is optional, `GuzzleHttp\Client` will be used as default.
*/
            new Client(),
            $config
        );

        # Request initialization

        # Specify keywords
        // $keyword = 'Harry Potter';

        /*
 * Specify the category in which search request is to be made
 * For more details, refer: https://webservices.amazon.com/paapi5/documentation/use-cases/organization-of-items-on-amazon/search-index.html
 */
        $searchIndex = "All";

        # Specify item count to be returned in search result
        $itemCount = 1;

        /*
 * Choose resources you want from SearchItemsResource enum
 * For more details, refer: https://webservices.amazon.com/paapi5/documentation/search-items.html#resources-parameter
 */
        $resources = array(
            SearchItemsResource::ITEM_INFOTITLE,
            SearchItemsResource::OFFERSLISTINGSPRICE
        );

        # Forming the request
        $searchItemsRequest = new SearchItemsRequest();
        $searchItemsRequest->setSearchIndex($searchIndex);
        $searchItemsRequest->setKeywords($keyword);
        $searchItemsRequest->setItemCount($itemCount);
        $searchItemsRequest->setPartnerTag($partnerTag);
        $searchItemsRequest->setPartnerType(PartnerType::ASSOCIATES);
        $searchItemsRequest->setResources($resources);

        # Validating request
        $invalidPropertyList = $searchItemsRequest->listInvalidProperties();
        $length = count($invalidPropertyList);
        if ($length > 0) {
            return null;
        }

        # Sending the request
        try {
            $searchItemsResponse = $apiInstance->searchItems($searchItemsRequest);
            # Parsing the response
            return $searchItemsResponse;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
