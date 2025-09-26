<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function register(StoreUserRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role ?? 'user', // role padrão caso não informado
            'password' => Hash::make($request->password)
        ]);

        return $this->success([
            'user'  => $user,
            'token' => $user->createToken('Token do usuario ' . $user->name)->plainTextToken
        ]);
    }

    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error(null, 'Email incorreto ou senha inválida', 401);
        }

        $user = User::where('email', $request->email)->first();

        return $this->success([
            'user'  => $user,
            'token' => $user->createToken('Token do usuario ' . $user->name)->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success(null, 'Logout realizado com sucesso', 200);
    }
}
