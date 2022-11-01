<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExchangeRateCollection;
use App\Models\Bank;
use App\Models\ExchangeRate;
use App\Repository\ECBRepository;

class ECBController extends Controller
{
    public ECBRepository $repository;

    public function __construct(ECBRepository $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        $rates = $this->repository->getRates(request()->input('date'),
            request()->input('currency'),
            Bank::where('name', 'ECB')->firstOrFail()->id);

        return response()->json(new ExchangeRateCollection($rates), 200);
    }

    public function deleteDailyRates() {
        $deletedRows = $this->repository->deleteDaily('ECB');
        return response()->json(['deletedRows' => $deletedRows], 200);

    }

    public function deleteAllRates() {
        $deletedRows = $this->repository->deleteAll('ECB');
        return response()->json(['deletedRows' => $deletedRows], 200);
    }
}
