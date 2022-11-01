<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExchangeRateCollection;
use App\Models\Bank;
use App\Repository\BOCRepository;

class BOCController extends Controller
{
    public BOCRepository $repository;

    public function __construct(BOCRepository $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        $rates = $this->repository->getRates(
            request()->input('date'),
            request()->input('currency'),
            Bank::where('name', 'BOC')->firstOrFail()->id);

        return response()->json(new ExchangeRateCollection($rates), 200);
    }

    public function deleteDailyRates() {
        $deletedRows = $this->repository->deleteDaily('BOC');
        return response()->json(['deletedRows' => $deletedRows], 200);

    }

    public function deleteAllRates() {
        $deletedRows = $this->repository->deleteAll('BOC');
        return response()->json(['deletedRows' => $deletedRows], 200);
    }
}
