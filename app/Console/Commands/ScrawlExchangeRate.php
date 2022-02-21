<?php

namespace App\Console\Commands;

use App\Services\ExchangeService;
use Illuminate\Console\Command;

class ScrawlExchangeRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scawlExchangeRate';

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
      $exchangeService = new ExchangeService();
      $exchangeService->crawlerExchangeRateUSDToYen();
    }
}
