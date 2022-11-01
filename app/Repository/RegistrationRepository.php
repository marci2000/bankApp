<?php

namespace App\Repository;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class RegistrationRepository {
    public function store(StoreUserRequest $request) {
        $validated = $request->validated();
        $validated['is_admin'] = 0;

        $user = User::create($validated);

        auth()->login($user);
    }
}
