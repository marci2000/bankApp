<?php

namespace App\Http\Controllers;

use App\Http\Resources\BankCollection;
use App\Models\Bank;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index() {
        return view('components.calculator', [
            'banks' => new BankCollection(Bank::all()),
            'dates' => ExchangeRate::select('date')->distinct()->get(),
            'currenciesFrom' => ExchangeRate::select('currency1')->distinct()->get(),
            'currenciesTo' => ExchangeRate::select('currency2')->distinct()->get(),
            'result' => null,
        ]);
    }

    public function store(Request $request){
        $result = ExchangeRate::select('value', 'multiplier')
            ->where([
            ['bank_id', '=', Bank::where('name', $request->bankName)->firstOrfail()->id],
            ['currency1', '=', $request->currency1],
            ['currency2', '=', $request->currency2],
            ['date', '=', $request->date]
        ])->firstOrFail();
        return view('components.calculator', [
            'banks' => new BankCollection(Bank::all()),
            'dates' => ExchangeRate::select('date')->distinct()->get(),
            'currenciesFrom' => ExchangeRate::select('currency1')->distinct()->get(),
            'currenciesTo' => ExchangeRate::select('currency2')->distinct()->get(),
            'result' => ($result->value * (float)$request->value) / $result->multiplier,
        ]);
    }
}
