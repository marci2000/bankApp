<?php

namespace App\Jobs;

use App\Models\Bank;
use App\Models\Subscription;
use App\Services\BankService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DownloadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $bank;

    public string $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $bank, string $type)
    {
        $this->bank = $bank;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $className = "\\App\\Repository\\" . $this->bank . "Repository";
        $methodName = "save" . ucfirst($this->type) . "Rates";
        $bankRepository = new $className();
        $bankRepository->$methodName();

        $bankService = new BankService();
        $bankService->sendMail($this->bank);
    }
}
