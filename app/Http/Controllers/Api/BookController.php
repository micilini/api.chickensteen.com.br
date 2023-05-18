<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/* Requests */
use App\Http\Requests\BookHoursRequest;
use App\Http\Requests\BookingRequest;

/* Providers */
use App\Services\Book\BookService;

class BookController extends Controller{

    public function getHours(BookHoursRequest $request){
        $validated = $request->validated();
        $availableHours = BookService::returnAvailableHours($validated['data']);
        return response()->json(['success' => true, 'available_hours' => $availableHours], 200);
    }

    public function newBook(BookingRequest $request){
        $validated = $request->validated();
        if(BookService::checkIfHourIsAllowedToDate($validated['hour'], $validated['data'])){
            return BookService::newBooking($validated);
        }
        return response()->json(['errors' => true, 'message' => 'Algo de errado aconteceu, recarregue a página ou tente novamente mais tarde.'], 422);
    }

}
