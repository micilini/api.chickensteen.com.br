<?php

namespace App\Services\Login;

/* Models */
use App\Models\User;

class LoginService{

    public static function tryAuthUser($email, $password){
        $userPassword = User::where('nm_email', $email)->pluck('nm_password')->toArray();
        return (\Hash::check($password, (isset($userPassword[0])) ? $userPassword[0]: ''));
    }

    public static function getNameAndTokenFromEmail($email){
        return User::select('nm_name', 'nm_token')->where('nm_email', $email)->get()->toArray()[0];
    }

}