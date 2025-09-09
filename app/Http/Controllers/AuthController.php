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

    /**
     * Registro de novos usuários
     * Endpoint: POST /register
     * - Cria um novo usuário no sistema.
     * - O campo `role` é opcional, caso não seja enviado assume "user".
    */
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

    /**
     * Autenticação de usuário (login)
     * Endpoint: POST /login
    */
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

    /**
     * Logout do usuário autenticado
     * Endpoint: POST /logout
     * - Revoga apenas o token da sessão atual do usuário.
    */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success(null, 'Logout realizado com sucesso', 200);
    }
}
