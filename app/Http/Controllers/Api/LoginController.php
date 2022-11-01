<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Repository\LoginRepository;

class LoginController extends Controller {

    public LoginRepository $repository;

    public function __construct(LoginRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return response()->json(['message' => 'You have to log in.'], 403);
    }

    public function store(LoginUserRequest $request) {
        $token = $this->repository->login($request);
        if ($token) {
            return response()->json([
                'message' => 'You have logged in successfully!',
                'token' => $token]);
        }

        return response()->json([
            'message' => 'Login failed.',
        ]);
    }

    public function destroy() {
        auth()->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'You logged out successfully.']);
    }

}
