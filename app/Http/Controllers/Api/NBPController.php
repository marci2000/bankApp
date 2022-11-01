<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExchangeRateCollection;
use App\Models\Bank;
use App\Repository\NBPRepository;

class NBPController extends Controller
{
    public NBPRepository $repository;

    public function __construct(NBPRepository $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        $rates = $this->repository->getRates(request()->input('date'),
            request()->input('currency'),
            Bank::where('name', 'NBP')->firstOrFail()->id);

        return response()->json(new ExchangeRateCollection($rates), 200);
    }

    public function deleteDailyRates() {
        $deletedRows = $this->repository->deleteDaily('NBP');
        return response()->json(['deletedRows' => $deletedRows], 200);
    }

    public function deleteAllRates() {
        $deletedRows = $this->repository->deleteAll('NBP');
        return response()->json(['deletedRows' => $deletedRows], 200);
    }
}
