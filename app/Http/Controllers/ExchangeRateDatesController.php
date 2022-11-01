<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Repository\DropdownRepository;
use Illuminate\Http\Request;

class ExchangeRateDatesController extends Controller
{
    public function index() {
        $repository = new DropdownRepository();
        return response()->json($repository->getDates(
            Bank::where('name', request()->input('bankName'))->firstOrfail()->id
        ));
    }
}
