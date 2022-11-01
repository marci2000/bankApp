<?php

namespace App\Repository;

use App\Http\Requests\LoginUserRequest;
use App\Models\User;

class LoginRepository {
    public function login (LoginUserRequest $request) {
        $validated = $request->validated();

        if (auth()->attempt($validated)) {
            $user = User::where('email', $validated['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            auth()->login($user);

            return $token;
        }

        return 0;
    }
}
