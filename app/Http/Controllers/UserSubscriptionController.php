<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    public function show(User $user) {
        return view('components.user', [
            'user' => $user,
            'subscriptions' => $user->subscriptions()->get(),
        ]);
    }
}
