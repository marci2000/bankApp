<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Repository\RegistrationRepository;

class RegistrationController extends Controller {

    public RegistrationRepository $repository;

    public function __construct(RegistrationRepository $repository) {
        $this->repository = $repository;
    }

    public function store(StoreUserRequest $request) {
        $this->repository->store($request);

        return response()->json(['message' => 'Successful registration!'], 201);
    }

}
