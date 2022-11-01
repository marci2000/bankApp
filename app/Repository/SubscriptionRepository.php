<?php

namespace App\Repository;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Models\Bank;
use App\Models\Subscription;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Arr;


class SubscriptionRepository {
    public function store($request, $userId) {
        $request["user_id"] = $userId;
        $request["sent"] = 0;
        $request["bank_id"] = Bank::where('name', $request["bankName"])->firstOrfail()->id;

        Subscription::create(Arr::except($request, ['bankName']));
    }
}
