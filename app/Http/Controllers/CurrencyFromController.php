<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Repository\DropdownRepository;
use Illuminate\Http\Request;

class CurrencyFromController extends Controller
{
    public function index() {
        $repository = new DropdownRepository();
        $date = request()->input('date');
        $bankId = Bank::where('name', request()->input('bankName'))->firstOrfail()->id;
        if ($date) {
            $currency1 = $repository->getCurrency1ByBankAndDate($bankId, $date);
        } else {
            $currency1 = $repository->getCurrency1ByBank($bankId);

        }
        return response()->json($currency1);
    }
}
