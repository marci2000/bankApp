<?php

namespace App\Repository;

use App\Models\Bank;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Http;

class NBPRepository extends BanksRepository implements BankRepository
{
    protected $bankId;

    public function __construct() {
        $this->bankId = Bank::where('name', 'NBP')->firstOrfail()->id;
    }

    private function save($row, $date) {
        ExchangeRate::create([
            'bank_id' => $this->bankId,
            'currency1' => "PLN",
            'currency2' => $row["code"],
            'date' => \DateTime::createFromFormat("Y-m-d", $date),
            'value' => (float)$row["mid"],
            'multiplier' => 1
        ]);
    }

    public function saveDayRates()
    {
        $result = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get("http://api.nbp.pl/api/exchangerates/tables/a")[0];

        $date = $result["effectiveDate"];
        ExchangeRate::where('bank_id',$this->bankId)->where('date', $date)->delete();

        collect($result["rates"])->map(function ($row) use ($date) {
            $this->save($row, $date);
        });
    }

    public function saveAllRates()
    {
        // in a single request, we can get only the data of the last 67 days
        $result = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get("http://api.nbp.pl/api/exchangerates/tables/a/last/67/");

        collect()->range(0, 66)->map(function ($day) use ($result) {
            $date = $result[$day]["effectiveDate"];
            ExchangeRate::where('bank_id',$this->bankId)->where('date', $date)->delete();
            collect($result[$day]["rates"])->map(function ($row) use ($date) {
                $this->save($row, $date);
            });
        });
    }
}
