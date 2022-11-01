<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Resources\SubscriptionResorce;
use App\Models\Subscription;
use App\Repository\SubscriptionRepository;


class SubscriptionController extends Controller {

    public SubscriptionRepository $repository;

    public function __construct(SubscriptionRepository $repository) {
        $this->repository = $repository;
    }

    public function store(StoreSubscriptionRequest $request) {
        $this->repository->store($request);

        return response()->json(['message' => 'Successful subscription!'], 201);
    }

    public function index() {
        if (auth()->user()->getAuthIdentifierName() == "admin@admin.com") {
            return response()->json(new SubscriptionResorce(Subscription::all()));
        }

        $userId = auth()->user()->getAuthIdentifier();
        $subscriptions = Subscription::where('user_id', $userId)->get();
        return response()->json(new SubscriptionResorce($subscriptions));
    }
}
