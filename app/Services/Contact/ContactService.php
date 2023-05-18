<?php

namespace App\Services\Contact;

/* Models */
use App\Models\Contact;

class ContactService{

    public static function newContact($data){
        try{

            $contact = new Contact();
            $contact->nm_name = $data['nome_completo'];
            $contact->nm_cellphone = preg_replace('/\D/', '', $data["celular"]);
            $contact->nm_email = $data['email'];
            $contact->txt_message = $data['mensagem'];
            $contact->dt_datecreated = date_create()->format('Y-m-d H:i:s');
            $contact->save();

            return response()->json(['success' => true], 200);

        }catch(\Illuminate\Database\QueryException $e){
            return response()->json(['errors' => true, 'message' => 'Algo de errado aconteceu, recarregue a página ou tente novamente em alguns minutos.'], 422);
        }
    }

}