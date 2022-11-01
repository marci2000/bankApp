<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::where('is_admin', 0)->get();
        return response()->json(new UserCollection($users));
    }

    public function admin() {
        return auth()->user()->isAdmin();
    }

    public function destroy() {
        User::truncate();
        return response()->json([
            'message' => 'Deleted successfully.',
        ]);
    }




}
