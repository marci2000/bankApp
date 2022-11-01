<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Repository\DropdownRepository;
use Illuminate\Http\Request;

class CurrencyToController extends Controller
{
    public function index() {
        $repository = new DropdownRepository();
        $date = request()->input('date');
        $bankId = Bank::where('name', request()->input('bankName'))->firstOrfail()->id;
        if ($date) {
            $currency2 = $repository->getCurrency2ByBankAndDate($bankId, $date);
        } else {
            $currency2 = $repository->getCurrency2ByBank($bankId);
        }
        return response()->json($currency2);
    }
}
