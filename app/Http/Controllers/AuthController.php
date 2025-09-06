<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;   
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function register(StoreUserRequest $request)
    {
        // Criar usuário
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Retorno com token de autenticação
        return $this->success([
            'user'  => $user,
            'token' => $user->createToken('Token do user ' . $user->name)->plainTextToken,
        ]);
    }

    public function login(Request $request)
    {
        return response()->json('Meu método login');
    }

    public function logout(Request $request)
    {
        return response()->json('Meu método logout');
    }
}
