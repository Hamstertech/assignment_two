<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();
        /** @var \App\Models\User $user */
        $user = User::create([
            'name' => $data['data']['name'],
            'email' => $data['data']['email'],
            'password' => bcrypt($data['data']['password']),
        ]);
        
        $token = $user->createToken('main')->plainTextToken;
        
        return response([
            'user' => $user,
            'token' => $token,
        ]);
    }
    

    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();
        if (!Auth::attempt($data['data'])) {
            return response([
                'error' => 'Email or Password might be wrong'
            ], 422);
        };
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;
        
        return response([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
            'token' => $token
        ]);
    }
    

    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        // Revoke the token that was used to authenticate the current request...
        $user->tokens()->delete();
        
        return response([
            'success' => true
        ]);
    }
}
