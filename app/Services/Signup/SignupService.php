<?php

namespace App\Services\Signup;

/* Models */
use App\Models\User;

class SignupService{

    public static function newUser($data){
        try{
            $token = bin2hex(random_bytes(16));

            $user = new User();
            $user->nm_name = $data['nome_completo'];
            $user->nm_cellphone = preg_replace('/\D/', '', $data["celular"]);
            $user->nm_email = $data['email'];
            $user->nm_password = \Hash::make(substr($data["password"], 0, 100));
            $user->nm_token = $token;
            $user->dt_datecreated = date_create()->format('Y-m-d H:i:s');
            $user->dt_dateupdated = date_create()->format('Y-m-d H:i:s');
            $user->save();

            return response()->json(['success' => true, 'user_token' => $token, 'user_name' => $data['nome_completo']], 200);
        }catch(\Illuminate\Database\QueryException $e){ 
            return response()->json(['errors' => true, 'message' => 'Algo de errado aconteceu, recarregue a página ou tente novamente em alguns minutos.'], 422);
        }
    }



}