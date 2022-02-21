<?php

namespace App\Console\Commands;

use App\Services\Alibaba\AlibabaService;
use App\Services\Mercari\MercariService;
use App\Services\Rakunten\RakuntenService;
use App\Services\YahooShopping\YahooService;
use Illuminate\Console\Command;
class GetListCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getListCategory';

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
        $rakuten->getCategory(0);

        $yahooShopping = new YahooService();
        $yahooShopping->getCategory(1);

        $alibaba = new AlibabaService();
        $alibaba->getCategory('all');
        $mercari = new MercariService();
        $mercari->getCategory(null);
    }
}
