<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/* Requests */
use App\Http\Requests\SignupRequest;
use App\Http\Requests\LoginRequest;

/* Providers */
Use App\Services\Signup\SignupService;
Use App\Services\Login\LoginService;

class UserController extends Controller{

    public function signup(SignupRequest $request){
        $validated = $request->validated();
        return SignupService::newUser($validated);
    }

    public function login(LoginRequest $request){
        $validated = $request->validated();
        if(LoginService::tryAuthUser($validated['email'], $validated['password'])){
            $data = LoginService::getNameAndTokenFromEmail($validated['email']);
            return response()->json(['success' => true, 'user_token' => $data['nm_token'], 'user_name' => $data['nm_name']], 200);
        }
        return response()->json(['errors' => true, 'message' => 'Email/Senha não foram encontrados.'], 422);
    }

}
