<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class ExchangeRatesByDate extends Controller
{
    public function show(Bank $bank) {

        $date = request()->input('date');

        return view('components.bank',[
            'bank' => $bank,
            'data' => $date,
            'rates' => [$bank->exchangeRates()->where('date', $date)->get()],
        ]);
    }
}
