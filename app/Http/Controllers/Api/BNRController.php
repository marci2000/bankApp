<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExchangeRateCollection;
use App\Models\Bank;
use App\Repository\BNRRepository;

class BNRController extends Controller
{
    public BNRRepository $repository;

    public function __construct(BNRRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        $rates = $this->repository->getRates(
            request()->input('date'),
            request()->input('currency'),
            Bank::where('name', 'BNR')->firstOrFail()->id);

        return response()->json(new ExchangeRateCollection($rates), 200);
    }

    public function deleteDailyRates() {
        $deletedRows = $this->repository->deleteDaily('BNR');
        return response()->json(['deletedRows' => $deletedRows], 200);
    }

    public function deleteAllRates() {
        $deletedRows = $this->repository->deleteAll('BNR');
        return response()->json(['deletedRows' => $deletedRows], 200);
    }
}
