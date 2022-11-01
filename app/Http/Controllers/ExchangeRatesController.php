<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExchangeRatesController extends Controller {

    public function show(Bank $bank) {
        $rates = $bank->exchangeRates()
            ->select('date', DB::raw('count(id) as count'))
            ->groupBy('date')
            ->get();

        return view('components.selectDate', [
            'bankId' => $bank->id,
            'days' => $rates,
        ]);
    }
}
