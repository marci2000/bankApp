<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserWebCollection;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('components.users', [
            'users' => new UserCollection(User::paginate(15)),
            ]);
    }
}
