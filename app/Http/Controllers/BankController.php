<?php

namespace App\Http\Controllers;

use App\Http\Resources\BankCollection;
use App\Http\Resources\ExchangeRateCollection;
use App\Models\Bank;
use App\Models\ExchangeRate;
use App\Http\Resources\DailyExchangeRateResource;
use App\Repository\BankRepository;
use App\Repository\BanksRepository;
use App\Repository\BNRRepository;
use App\Services\Paginate;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BankController extends Controller
{
    public BanksRepository $repository;

    public function __construct(BanksRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {

        return view('components.banks', [
            'banks' => new BankCollection(Bank::all()),
        ]);
    }

    public function update(Request $request) {

        $this->repository->activate($request->bank);
        return back();
    }
}
