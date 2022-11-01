<?php

namespace App\Repository;

use App\Models\Bank;
use App\Models\ExchangeRate;

class DropdownRepository {

    public function getCurrency1ByBank($bankId) {
        return ExchangeRate::select('currency1')
            ->where('bank_id', $bankId)
            ->distinct()
            ->get();
    }

    public function getCurrency1ByBankAndDate($bankId, $date) {
        return ExchangeRate::select('currency1')
            ->where('bank_id', $bankId)
            ->where('date', $date)
            ->distinct()
            ->get();
    }

    public function getCurrency2ByBank($bankId) {
        return ExchangeRate::select('currency2')
            ->where('bank_id', $bankId)
            ->distinct()
            ->get();
    }

    public function getCurrency2ByBankAndDate($bankId, $date) {
        return ExchangeRate::select('currency2')
            ->where('bank_id', $bankId)
            ->where('date', $date)
            ->distinct()
            ->get();
    }

    public function getDates($bankId) {
        return ExchangeRate::select('date')
            ->where('bank_id', $bankId)
            ->distinct()
            ->get();
    }





}
