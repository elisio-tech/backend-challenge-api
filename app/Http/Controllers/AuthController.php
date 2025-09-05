<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function register(Request $request)
    {
        return response()->json('Meu metodo register');
    }

    public function login(Request $request)
    {
        return response()->json('Meu metodo login');
    }

    public function logout(Request $request)
    {
        return response()->json('Meu metodo logout');
    }
}
