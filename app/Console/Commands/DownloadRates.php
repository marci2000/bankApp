<?php

namespace App\Console\Commands;

use App\Jobs\DownloadAllJob;
use App\Jobs\DownloadBNRAllJob;
use App\Jobs\DownloadBNRDailyJob;
use App\Jobs\DownloadDailyJob;
use App\Jobs\DownloadECBAllJob;
use App\Jobs\DownloadECBDailyJob;
use App\Jobs\DownloadJob;
use Illuminate\Console\Command;

class DownloadRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:rates {--bank=all} {--type=day}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download the exchange rates from different national banks.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $bank = $this->option('bank');
        $type = $this->option('type');

        $possibleBanks = ['BNR', 'ECB', 'NBP', 'BOC', 'all'];
        $possibleTypes = ['day', 'all'];

        if (!in_array($bank, $possibleBanks)) {
            $this->error("Incorrect bank parameter!");
            return;
        }

        if (!in_array($type, $possibleTypes)) {
            $this->error("Incorrect type parameter!");
            return;
        }

        if ($bank == "all") {

            collect($possibleBanks)->each(function($bank) use ($type) {
                DownloadJob::dispatch($bank, $type);
            });
            $this->info("Downloaded successfully!");
            return;
        }

        DownloadJob::dispatch($bank, $type);
        $this->info("Downloaded successfully!");

    }
}
