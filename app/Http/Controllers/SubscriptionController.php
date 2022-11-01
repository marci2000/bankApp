<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Resources\BankCollection;
use App\Http\Resources\SubscriptionCollection;
use App\Models\Bank;
use App\Models\ExchangeRate;
use App\Models\Subscription;
use App\Models\User;
use App\Repository\SubscriptionRepository;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public SubscriptionRepository $repository;

    public function __construct(SubscriptionRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return view('components.subscribe', [
            'banks' => new BankCollection(Bank::all()),
            'currenciesFrom' => ExchangeRate::select('currency1')->distinct()->orderBy('currency1')->get(),
            'currenciesTo' => ExchangeRate::select('currency2')->distinct()->orderBy('currency2')->get(),
        ]);
    }

    public function store(StoreSubscriptionRequest $request) {
        unset($request['_token']);
        $this->repository->store($request->validated(), auth()->user()->getAuthIdentifier());

        session()->flash('message', 'You have subscribed successfully!');
        return redirect('/');
    }

    public function show() {
        if (!auth()->user()->isAdmin()) {
            $subscriptions = new SubscriptionCollection(Subscription::where('user_id', auth()->user()?->getAuthIdentifier())->get());
        } else {
            $subscriptions = new SubscriptionCollection(Subscription::all());
        }
        return view('components.subscriptions', [
            'subscriptions' => $subscriptions,
        ]);
    }

    public function destroy(Subscription $subscription) {
        $subscription->delete();
        return back();
    }
}
