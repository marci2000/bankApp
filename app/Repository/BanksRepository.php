<?php

namespace App\Repository;

use App\Http\Resources\ExchangeRateCollection;
use App\Models\Bank;
use App\Models\ExchangeRate;

class BanksRepository {

    public function getRates($date, $currency, $bankId) {

        $bank = Bank::where('bank_id',$bankId)->get();

        if (is_null($date) && is_null($currency)) {
            return $bank->exchangeRates;
        }

        if (is_null($date)) {
            return $bank->exchangeRates()
                ->where('currency2', $currency)
                ->get();
        }

        if (is_null($currency)) {
            return $bank->exchangeRates()
                ->where('date', $date)
                ->get();
        }

        return $bank->exchangeRates()
            ->where('date', $date)
            ->where('currency2', $currency)
            ->firstOrFail();
    }

    public function getTodayRates() {
        return collect(["BNR", "ECB", "NBP", "BOC"])->map(function ($bankName) {
            $latestDate = ExchangeRate::date($bankName);

            $bank = Bank::where('id', Bank::where('name', $bankName)->firstOrfail()->id)->firstOrFail();

            return [
                'abbreviation' => $bankName,
                'name' => $bank->abbreviation,
                'date' => $latestDate,
                'rates' => new ExchangeRateCollection($bank->exchangeRates()->where('date',$latestDate)->get()),
            ];
        });
    }

    public function deleteAll($name) {
        $bank = Bank::where('bank_id', Bank::where('name', $name)->firstOrfail()->id)->firstOrFail();
        return $bank->exchangeRates()->delete();
    }

    public function deleteDaily($name) {
        $bank = Bank::where('bank_id', Bank::where('name', $name)->firstOrfail()->id)->firstOrFail();
        return $bank->exchangeRates()
            ->where('date', ExchangeRate::date($name))
            ->delete();
    }

    public function activate($bankId) {
        $bank = Bank::where('id', $bankId)->firstOrFail();
        $bank->update(['is_active' => !$bank["is_active"]]);
        $bank->save();
    }
}
