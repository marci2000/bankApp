<?php

namespace App\Http\Controllers;

use App\Repository\BanksRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class DailyExchangeRatesController extends Controller
{
    private function paginate($items, $perPage = 3, $page = null, $options = []) {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function index() {

        $repository = new BanksRepository();

        $dailyRate = $this->paginate($repository->getTodayRates());

        return view('components.dailyRates', [
            'dailyRates' => $dailyRate,
        ]);
    }
}
