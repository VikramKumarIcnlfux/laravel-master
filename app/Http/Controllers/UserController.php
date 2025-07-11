<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $user = User::find(1);

        // ❌ ERROR 1: Calling undefined method
        $user->nonExistentMethod();

        // ❌ ERROR 2: Accessing undefined property
        $email = $user->non_existing_property;

        return response()->json(['email' => $email]);
    }
}
