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
        // Criar usuário
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Retorno com token de autenticação
        return $this->success([
            'user'  => $user,
            'token' => $user->createToken('Token do usuario ' . $user->name)->plainTextToken
        ]);
    }

    public function login(LoginUserRequest $request)
    {
         // Verifica credenciais
        if(!Auth::attempt($request->only('email', 'password')))
        {
            return $this->error(null, 'Email incorreto ou senha inválida', 401);
        }

        $user = User::where('email', $request->email)->first();
    
        // Retorno user com token de autenticação
        return $this->success([
            'user'  => $user,
            'token' => $user->createToken('Token do usuario ' . $user->name)->plainTextToken
        ]);
        
    }

    public function logout(Request $request)
    {
        return response()->json('Meu método logout');
    }
}
