<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/* Requests */
use App\Http\Requests\ContactRequest;

/* Services */
use App\Services\Contact\ContactService;

class ContactController extends Controller{

    public function newContact(ContactRequest $request){
        $validated = $request->validated();
        return ContactService::newContact($validated);
    }

}
