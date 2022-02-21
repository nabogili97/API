<?php

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Cache;
/**
 * validate jancode
 * 
 *@param string $jancode
 *@return bool
 */
function checkJancode($jancode)
{
    if (strlen($jancode) < config('contant.minLongJancode'))
        return false;
    $re = '/^[0-9]{1,}$/m';
    preg_match_all($re, $jancode, $matches, PREG_SET_ORDER, 0);
    return $matches;
}

if (!function_exists('getJancodeRakutenSearch')) {

    /**
     *Split jancode from smallImageUrl 
     *
     *@param string $smallImageUrl
     *@return string jancode
     */
    function getJancodeRakutenSearch($imageUrl)
    {
        $arrImageUrl = explode('/', $imageUrl);
        if (!isset($arrImageUrl[4]) || strlen($arrImageUrl[4]) < config('contant.minLongJancode')) {
            return '';
        }
        $nameImage = $arrImageUrl[4];

        $jancode = str_replace('/', '', $nameImage);

        if (checkJancode($jancode))
            return $jancode;
        return '';
    }
}
    /**
     * Split jancode from itemCaption 
     * 
     * @param string $smallImageUrl
     *@return string jancode
     */
    function getJancodeRakutenRankKingByitemCaption($itemCaption) {
        $arrImageUrl = explode('単品JAN：', $itemCaption);
        if(isset($arrImageUrl[1]))
            return explode('/', $arrImageUrl[1])[0];
        
        return '';
    }

if (!function_exists('getJancodeRakutenRankKing')) {

    /**
     *Split jancode from smallImageUrl 
     *
     *@param string $smallImageUrl
     *@return string jancode
     */
    function getJancodeRakutenRankKing($smallImageUrl, $itemCaption)
    {   
        $jancodeByItemCaption = getJancodeRakutenRankKingByitemCaption($itemCaption);
        if($jancodeByItemCaption !=='')
            return $jancodeByItemCaption;

        $arrSmallImageUrl = preg_split("/[\/,]+/", $smallImageUrl);
        if (!isset($arrSmallImageUrl[6]) || strlen($arrSmallImageUrl[6]) < config('contant.minLongJancode')) {
            return '';
        }
        $nameImage = $arrSmallImageUrl[6];
        $nameImage = preg_split("/[\_,]+/", $nameImage);

        $jancode = str_replace('1001000', '', $nameImage[0]);
        $jancode = substr($jancode, 0, 13);

        if (checkJancode($jancode))
            return $jancode;
        return '';
    }
}

if (!function_exists('getJancodeYahooRankKing')) {

    /**
     *Split jancode from imageUrl
     *
     *@param string $imageUrl
     *@return string jancode
     */
    function getJancodeYahooRankKing($imageUrl)
    {
        $arrImageUrl = explode('page_key=', $imageUrl);
        $jancode = $arrImageUrl[1];

        if (checkJancode($jancode))
            return $jancode;
        return '';
    }
}

if (!function_exists('getLinkReviewRakuten')) {

    /**
     * Get link reviewRakunten
     * 
     * @param string $jancode
     * @return string url
     */
    function getLinkReviewRakuten($jancode)
    {
        if ($jancode === '') {
            return '';
        }
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('contant.rakuten.base_uri'),
            // You can set any number of default request options.
            'timeout' => 5.0,
        ]);

        $response = $client->request('GET', '/services/api/Product/Search/20170426', [
            'query' => [
                'keyword' => $jancode,
                'applicationId' => '1082087539982223109'
            ]
        ]);
        $response = json_decode($response->getBody(), true);
        if (!isset($response['Products'][0]))
            return '';
        return $response['Products'][0]['Product']['reviewUrlPC'];
    }
}

function fakerDataSearchAmazon()
{
    $response = [];
    $arrASIN = ['B0932QJ2JZ', 'B0931Y6CPF', 'B01DPSJQRG'];
    $arrTitleDisplayValue = ['New Apple AirTag 4 Pack', '2021 Apple iMac (24-inch, Apple M1 chip with 8‑core CPU and 8‑core GPU, 8GB RAM, 512GB) - Silver', 'Apple Lightning to USB-C Cable (2 m)'];
    $arrImagesUrl = ['https://m.media-amazon.com/images/I/71gY9E+cTaS._AC_UY218_.jpg', 'https://m.media-amazon.com/images/I/61LNnZPoKPS._AC_UY218_.jpg', 'https://m.media-amazon.com/images/I/51oyNABMwuL._AC_UY218_.jpg'];
    $arrDetail = ['https://www.amazon.com/dp/B0932QJ2JZ/?psc=1', 'https://www.amazon.com/dp/B0931Y6CPF/?psc=1', 'https://www.amazon.com/dp/B01DPSJQRG/?psc=1'];
    $arrAmount = [99, 1699, 32];
    for ($i = 0; $i < 3; $i++) {
        array_push(
            $response,
            [
                "SearchResult" => [
                    "Items" => [
                        [
                            "ASIN" => $arrASIN[$i],
                            "DetailPageURL" => $arrDetail[$i],
                            "Images" => [
                                "Primary" => [
                                    "Medium" => [
                                        "Height" => 134,
                                        "URL" => $arrImagesUrl[$i],
                                        "Width" => 160
                                    ]
                                ]
                            ],
                            "ItemInfo" => [
                                "Title" => [
                                    "DisplayValue" => $arrTitleDisplayValue[$i],
                                    "Label" => "Title",
                                    "Locale" => "en_US"
                                ]
                            ],
                            "Offers" => [
                                "Listings" => [
                                    [
                                        "Condition" => [
                                            "DisplayValue" => "nuevo",
                                            "Label" => "Condición",
                                            "Locale" => "es_US",
                                            "Value" => "New"
                                        ],
                                        "Id" => "l2dKMJRrPVX3O7DAPQ6DWLXBjBeRYsruAnKVf1LNXyjFTUw%2FnNBn41CJV2489iPYMSGuynW8uuwMQ7GhGrcT9F%2F%2FgO5bdp%2B2l0HbPvvHy05ASCdqrOaxWA%3D%3D",
                                        "Price" => [
                                            "Amount" => $arrAmount[$i],
                                            "Currency" => "USD",
                                            "DisplayAmount" => "$52.16",
                                            "Savings" => [
                                                "Amount" => 34.77,
                                                "Currency" => "USD",
                                                "DisplayAmount" => "$34.77 (40%)",
                                                "Percentage" => 40
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    "SearchURL" => "https://www.amazon.com/s/?field-keywords=Harry+Potter&search-alias=aps&tag=dgfd&linkCode=osi",
                    "TotalResultCount" => 146
                ]
            ]
        );
    }
    return $response;
}

function fakerDataSellRankingAmazon()
{

    $response = [];
    $arrASIN = ['B08BX7N9SK', 'B08VLMQ3KS', 'B08BX7QGKF', 'B0932QJ2JZ', 'B0931Y6CPF', 'B01DPSJQRG'];
    $arrTitleDisplayValue = ['Samsung Galaxy Note 20 Ultra 5G Factory Unlocked Android Cell Phone, US Version, 128GB of Storage, Mobile Gaming Smartphone, Long-Lasting Battery, Mystic Bronze', 'Samsung Galaxy S21 5G, US Version, 128GB, Phantom Gray - Unlocked (Renewed)', 'Samsung Galaxy Note 20 Ultra 5G Factory Unlocked Android Cell Phone, US Version, 128GB of Storage, Mobile Gaming Smartphone, Long-Lasting Battery, Mystic White', 'New Apple AirTag 4 Pack', '2021 Apple iMac (24-inch, Apple M1 chip with 8‑core CPU and 8‑core GPU, 8GB RAM, 512GB) - Silver', 'Apple Lightning to USB-C Cable (2 m)'];
    $arrImagesUrl = ['https://m.media-amazon.com/images/I/81AT+Flc+EL._AC_UY218_.jpg', 'https://m.media-amazon.com/images/I/81-elh9CazL._AC_UY218_.jpg', 'https://m.media-amazon.com/images/I/81NKXayE47L._AC_UY218_.jpg', 'https://m.media-amazon.com/images/I/71gY9E+cTaS._AC_UY218_.jpg', 'https://m.media-amazon.com/images/I/61LNnZPoKPS._AC_UY218_.jpg', 'https://m.media-amazon.com/images/I/51oyNABMwuL._AC_UY218_.jpg'];
    $arrDetail = ['https://www.amazon.com/dp/B08BX7N9SK/?psc=1', 'https://www.amazon.com/dp/B08VLMQ3KS/?psc=1', 'https://www.amazon.com/dp/B08BX7QGKF/?psc=1', 'https://www.amazon.com/dp/B0932QJ2JZ/?psc=1', 'https://www.amazon.com/dp/B0931Y6CPF/?psc=1', 'https://www.amazon.com/dp/B01DPSJQRG/?psc=1'];
    $arrAmount = [3790, 546, 1299, 99, 1699, 32];
    for ($i = 0; $i < 6; $i++) {
        array_push(
            $response,
            [
                "SearchResult" => [
                    "Items" => [
                        [
                            "Rank" => $i + 1,
                            "ASIN" => $arrASIN[$i],
                            "DetailPageURL" => $arrDetail[$i],
                            "Images" => [
                                "Primary" => [
                                    "Medium" => [
                                        "Height" => 134,
                                        "URL" => $arrImagesUrl[$i],
                                        "Width" => 160
                                    ]
                                ]
                            ],
                            "ItemInfo" => [
                                "Title" => [
                                    "DisplayValue" => $arrTitleDisplayValue[$i],
                                    "Label" => "Title",
                                    "Locale" => "en_US"
                                ]
                            ],
                            "Offers" => [
                                "Listings" => [
                                    [
                                        "Condition" => [
                                            "DisplayValue" => "nuevo",
                                            "Label" => "Condición",
                                            "Locale" => "es_US",
                                            "Value" => "New"
                                        ],
                                        "Id" => "l2dKMJRrPVX3O7DAPQ6DWLXBjBeRYsruAnKVf1LNXyjFTUw%2FnNBn41CJV2489iPYMSGuynW8uuwMQ7GhGrcT9F%2F%2FgO5bdp%2B2l0HbPvvHy05ASCdqrOaxWA%3D%3D",
                                        "Price" => [
                                            "Amount" => $arrAmount[$i],
                                            "Currency" => "USD",
                                            "DisplayAmount" => "$52.16",
                                            "Savings" => [
                                                "Amount" => 34.77,
                                                "Currency" => "USD",
                                                "DisplayAmount" => "$34.77 (40%)",
                                                "Percentage" => 40
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    "SearchURL" => "https://www.amazon.com/s/?field-keywords=Harry+Potter&search-alias=aps&tag=dgfd&linkCode=osi",
                    "TotalResultCount" => 146
                ]
            ]
        );
    }
    return $response;
}

function fakerDataCategoryAmazon()
{
    $response = [];
        array_push($response, [
            "Children" => [
                [
                    "ContextFreeName" => "Children's Adoption Books",
                    "DisplayName" => "Adoption",
                    "Id" => 3046
                ],
                [
                    "ContextFreeName" => "Children's Collectible Books",
                    "DisplayName" => "Photo",
                    "Id" => 265414
                ],
                [
                    "ContextFreeName" => "Children's Collectible Books",
                    "DisplayName" => "Photo",
                    "Id" => 59856
                ],
                [
                    "ContextFreeName" => "Children's Collectible Books",
                    "DisplayName" => "Photo",
                    "Id" => 108423
                ],
                [
                    "ContextFreeName" => "Children's Babysitting Books",
                    "DisplayName" => "Babysitting",
                    "Id" => 748445 
                ],
                [
                    "ContextFreeName" => "Children's Collectible Books",
                    "DisplayName" => "Photo",
                    "Id" => 198423
                ],
                [
                    "ContextFreeName" => "Collectible's require  Books",
                    "DisplayName" => "Photo",
                    "Id" => 1084543 
                ],
                [
                    "ContextFreeName" => "Children's Values Books",
                    "DisplayName" => "Values",
                    "Id" => 316889
                ]
            ]
        ]);


        $response = [];
    $arrASIN = ['B08BX7N9SK', 'B08VLMQ3KS', 'B08BX7QGKF', 'B0932QJ2JZ', 'B0931Y6CPF', 'B01DPSJQRG'];
    $arrCategoryId = [3790, 546, 1299, 99, 1699, 32];
    for ($i = 0; $i < 6; $i++) {
        array_push(
            $response,
            [
                "CategoryResult" => [
                    "category" => [
                        [
                            "ContextFreeName" => "Children". $arrASIN[$i] ."Books",
                            "DisplayName" => "Values",
                            "Id" => $arrCategoryId[$i]
                        ]
                    ]
                ]
            ]
        );
    }
    return $response;
}

/**
 * cut string keyword from '/'
 * 
 * @param string $keyword
 * @return string
 */
 function cutKeyword($keyword) {
    $indexEnd = strpos($keyword, '/');
    if(!$indexEnd)
    return $keyword;

    $str = substr($keyword, 0, $indexEnd + 1);
    $keyword = str_replace($str,'', $keyword);
    return $keyword;
 }

/**
 * get string between 
 * 
 * @param  string $string, 
 * @param string $start, 
 * @param string $end
 * @return string
 */
function getStringBetween($string, $start, $end) {
    $string = ' ' . $string;
    $indexStart = strpos($string, $start);
    if ($indexStart == 0) return '';
    $indexStart += strlen($start);
    $len = strpos($string, $end, $indexStart) - $indexStart;
    return substr($string, $indexStart, $len);
}

/**
 * handleKeyword delete special Characters 
 * 
 * @param string $keyword
 * @return string $keyword
 */
function handleKeyword($keyword) {
    //$keyword = "【期間限定値下げ中！】【6／27「日曜日の初耳学」紹介】【予約：7月下～】2021年モデル　Sleeim　スリーム　振動で通常呼吸への回復をサポートするウェアラブルデバイス（ONEA）【送料無料】【海外】【ポイント12倍】【6／30】【s7】";    
    //$keyword = "【送料無料】【ラッピング不可】◇2660　排気口カバースマート＜フラット＞KS　60cmタイプ◇【1621088】□【コンロ奥 油はねガード】【ヨシカワ 直営 yoshikawa 燕三条産】";
    //$keyword = "排気口カバースマート＜フラット＞KS　60cmタイプ";
    $keyword = cutKeyword($keyword);
    for($i = 0; $i<10; $i++)
    {
        $dateSale = '【'. getStringBetween($keyword,'【','】').'】';
        $keyword = str_replace($dateSale, ' ', $keyword);
    }
     //delete special Characters
     $specialCharacters = config('contant.specialCharacters');
     foreach ($specialCharacters as $item) {
         $keyword = str_replace($item, ' ', $keyword);
     }
     $keyword = trim($keyword);
        if (strlen($keyword) > config('contant.minLongKeyword')) {
            $keyword = mb_substr($keyword, 0, config('contant.minLongKeyword'));
        }
    return $keyword;
}

/**
 * ramdon proxy
 */
function ramdonProxy()
{

    $listProxy = config('contant.listProxy');
    $index = rand(0,99);
    return $listProxy[$index];
}
