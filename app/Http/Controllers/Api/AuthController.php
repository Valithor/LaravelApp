<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function local()
    {
        $user = auth()->user();
        $user->abilities = auth()->user()->getAbilities();
        return response()->json($user);
    }

}
