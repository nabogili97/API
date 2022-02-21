<?php

namespace App\Console\Commands;

use App\Services\Alibaba\AlibabaService;
use App\Services\Mercari\MercariService;
use Illuminate\Console\Command;
use App\Services\Rakunten\RakuntenService;
use App\Services\YahooShopping\YahooService;

class GetProductSallInDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getProductSallInDay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rakuten = new RakuntenService();
        for($i = 1; $i++; $i<=5) 
        {
            $rakuten->getTopSaleInDay(0, $i);
        }
        $page = [ 1, 21, 41, 61, 81 ];
        for($i = 0; $i < 5; $i++)
        $yahooShopping = new YahooService();
        $yahooShopping->getTopSaleInDay(1, $page[$i]);

        $alibaba = new AlibabaService();
        $alibaba->getTopSaleInDay('', 1);
        $mercari = new MercariService();
        $mercari->getTopSaleInDay(null, 0);
    }
}
