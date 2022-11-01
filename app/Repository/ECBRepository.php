<?php

namespace App\Repository;

use App\Models\Bank;
use App\Models\ExchangeRate;

class ECBRepository extends BanksRepository implements BankRepository {

    protected $bankId;

    public function __construct() {
        $this->bankId = Bank::where('name', 'ECB')->firstOrfail()->id;
    }

    protected function save($element, $date) {
        foreach($element as $line) {
            ExchangeRate::create([
                'bank_id' => $this->bankId,
                'currency1' => "EUR",
                'currency2' => $line["currency"],
                'date' => \DateTime::createFromFormat("Y-m-d", $date),
                'value' => (float)$line["rate"],
                'multiplier' => 1
            ]);
        }
    }

    public function saveDayRates() {
        $xmlContent = file_get_contents("https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
        $xml = new \SimpleXMLElement($xmlContent);
        $date = $xml->Cube->Cube["time"];

        ExchangeRate::where('bank_id',$this->bankId)->where('date', $date)->delete();

        $this->save($xml->Cube->Cube->Cube, $date);
    }

    public function saveAllRates() {
        $xmlContent = file_get_contents("https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist.xml?44d1f1bc7b81908ac3c4c50ff1d035c6");
        $xml = new \SimpleXMLElement($xmlContent);
        foreach ($xml->Cube->Cube as $dailyData) {
            $date = $dailyData["time"];

            ExchangeRate::where('bank_id',$this->bankId)->where('date', $date)->delete();

            $this->save($dailyData->Cube, $date);
        }
    }
}
