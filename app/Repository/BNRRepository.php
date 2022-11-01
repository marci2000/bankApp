<?php

namespace App\Repository;

use App\Http\Resources\ExchangeRateCollection;
use App\Http\Resources\ExchangeRateResource;
use App\Models\Bank;
use App\Models\ExchangeRate;

class BNRRepository extends BanksRepository implements BankRepository {

    protected $bankId;

    public function __construct() {
        $this->bankId = Bank::where('name', 'BNR')->firstOrfail()->id;
    }

    protected function save($element, $date) {
        foreach($element as $line) {
            ExchangeRate::create([
                'bank_id' => $this->bankId,
                'currency1' => "RON",
                'currency2' => $line["currency"],
                'date' => \DateTime::createFromFormat("Y-m-d", $date),
                'value' => (float)$line,
                'multiplier' => $line["multiplier"] ?: 1
            ]);
        }
    }

    public function saveDayRates() {
        $xmlContent = file_get_contents("http://www.bnro.ro/nbrfxrates.xml");
        $xml = new \SimpleXMLElement($xmlContent);
        $date = $xml->Header->PublishingDate;

        ExchangeRate::where('bank_id', $this->bankId)->where('date', $date)->delete();

        $this->save($xml->Body->Cube->Rate, $date);
    }

    public function saveAllRates() {
        $year = date("Y");
        $yearCollection = collect()->range(2005,$year);
        $yearCollection->map(function($date) {
            $url = "https://bnr.ro/files/xml/years/nbrfxrates{$date}.xml";
            $xmlContent = file_get_contents($url);
            $xml = new \SimpleXMLElement($xmlContent);

            foreach ($xml->Body->Cube as $dailyData) {
                $date = $dailyData["date"];

                ExchangeRate::where('bank_id',$this->bankId)->where('date', $date)->delete();

                $this->save($dailyData->Rate, $date);
            }
        });
    }
}
