<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Cache;

class ExchangeService
{   
    /**
     * scrawler exchang rate usd to yen
     * 
     * @return float $exchangRate
     */
    public function crawlerExchangeRateUSDToYen()
    {
        $client = new Client();
        try {
        $crawler = $client->request('GET', 'https://vn.exchange-rates.org/converter/USD/JPY/1/Y', ['proxy' => ramdonProxy()]);
        // dd($crawler->filter('#ctl00_M_lblToAmount'));
            $exchangRate = $crawler->filter('#ctl00_M_lblToAmount')->text();
            $exchangRate = str_replace(',', '.', $exchangRate);
            $exchangRate =  (float)$exchangRate;
            Cache::put('exchangeRateUSDToYen', $exchangRate, config('contant.timeSaveCacheExchangRate'));
            return  $exchangRate;
        } catch (\Throwable $th) {
            return $exchangRate = 110.09;
        }
    }

    /**
     *  get exchange rate usd to yen
     * 
     * @return float $exchangRate
     */
    public function getExchangeRateUSDToYen()
    {
        if (Cache::has('exchangeRateUSDToYen')) {
            $exchangeRateUSDToYen = Cache::get('exchangeRateUSDToYen');
            return $exchangeRateUSDToYen;
        }
        $exchangRate = $this->crawlerExchangeRateUSDToYen();
        Cache::put('exchangeRateUSDToYen', $exchangRate, config('contant.timeSaveCacheExchangRate'));
        return $exchangRate;
    }
}