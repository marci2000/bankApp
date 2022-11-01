<?php

namespace App\Repository;

use App\Http\Resources\ExchangeRateCollection;
use App\Http\Resources\ExchangeRateResource;
use App\Models\Bank;
use App\Models\ExchangeRate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class BOCRepository extends BanksRepository implements BankRepository {

    protected $bankId;

    public function __construct() {
        $this->bankId = Bank::where('name', 'BOC')->firstOrfail()->id;
    }

    protected function save($element, $date) {
        foreach($element as $line) {
            ExchangeRate::create([
                'bank_id' => $this->bankId,
                'currency1' => "CAD",
                'currency2' => $line["currency"],
                'date' => \DateTime::createFromFormat("Y-m-d", $date),
                'value' => (float)$line,
                'multiplier' => $line["multiplier"] ?: 1
            ]);
        }
    }

    public function saveDayRates()
    {
        $result = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get("https://www.bankofcanada.ca/valet/observations/group/FX_RATES_DAILY/json")["observations"];
        $lastDay = end($result);
        $date = $lastDay["d"];
        collect($lastDay)->except(["d"])->map(function($item, $key) use ($date) {
            ExchangeRate::create([
                'bank_id' => $this->bankId,
                'currency1' => "CAD",
                'currency2' => substr($key, 2,3),
                'date' => \DateTime::createFromFormat("Y-m-d", $date),
                'value' => (float)$item["v"],
                'multiplier' =>  1
            ]);
        });
    }

    public function saveAllRates()
    {
        $result = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get("https://www.bankofcanada.ca/valet/observations/group/FX_RATES_DAILY/json")["observations"];
        $collection = collect($result);
        $collection->map(function($dailyRates) {
            $date = $dailyRates["d"];
            collect($dailyRates)->except(["d"])->map(function($item, $key) use ($date) {
                ExchangeRate::create([
                    'bank_id' => $this->bankId,
                    'currency1' => "CAD",
                    'currency2' => substr($key, 2,3),
                    'date' => \DateTime::createFromFormat("Y-m-d", $date),
                    'value' => (float)$item["v"],
                    'multiplier' =>  1
                ]);
            });
        });
    }
}
