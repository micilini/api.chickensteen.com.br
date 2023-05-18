<?php

namespace App\Services\Book;

/* Models */
use App\Models\Book;
use App\Models\User;

class BookService{

    private static $allowedEvents = array(1 => 'festa', 2 => 'aniversario', 3 => 'evento', 4 => 'confraternizacao', 5 => 'outro');
    private static $allowedPlaces = array(1 => 'varanda', 2 => 'salao');

    private static $avaiableHours = array(0 => array(
        '12' => 0,
        '13' => 0,
        '14' => 0,
        '15' => 0,
        '16' => 0,
        '17' => 0,
        '18' => 0,
        '19' => 0,
        '20' => 0,
        '21' => 0,
        '22' => 0,
        '23' => 0
    ),
    1 => array(
        18 => 0,
        19 => 0,
        20 => 0,
        21 => 0,
        22 => 0,
        23 => 0
    ));

    /* BOOK SYSTEM */

    public static function returnAvailableHours($date, $format = 'Y-m-d'){
        //Converte a data para o formato aceito pelo banco de dados
        $date = \DateTime::createFromFormat($format, $date)->format('Y-m-d');

        //1) Selecionar em books todos os registros onde dt_dateevent estiverem relacionados com $date (is_active for TRUE)
        $allStorageBooks = self::getAllBooksFromSpecificDate($date);
        //var_dump($allStorageBooks);

        //2) Com esses dados em mãos, devemos fazer um loop deles retornando extraindo seus horários e a quantidade de repetições de registros nesses horarios.
        $selectedDates = self::getAllSelectedDates($allStorageBooks);
        //var_dump($selectedDates);

        //3) Retorna o nome do dia da semana de acordo com a data 
        $dayWeek = self::returnNameOfDayWeek($date);
        //echo $dayWeek;

        //4) Validações Finais
        $allBooks = self::mergeArrayWithValueOfSecondArray(self::$avaiableHours[($dayWeek < 1) ? 0 : 1], $selectedDates);
        $allBooks = self::removeHoursLessThanNowAndCrowded($allBooks, $date);
        return $allBooks;
    }

    private static function getAllBooksFromSpecificDate($date){
        return Book::select('dt_dateevent')->where('is_active', 1)->whereDate('dt_dateevent', $date)->get()->toArray();
    }

    private static function getAllSelectedDates($allBooks){
        $selectedDates = array();
        foreach ($allBooks as $value){
            $keyHour = self::extractFirstPieceOfHourFromDate($value['dt_dateevent']);
            if(isset($selectedDates[$keyHour])){
                $selectedDates[$keyHour] = $selectedDates[$keyHour] + 1;
            }else{
                $selectedDates[$keyHour] = 1;
            }
        }
        return $selectedDates;
    }

    private static function extractFirstPieceOfHourFromDate($date){
        $piecesDate = explode(" ", $date);
        $hour = $piecesDate[1];
        $piecesHour = explode(":", $hour);
        return $piecesHour[0];
    }

    private static function returnNameOfDayWeek($date){
        return date('w', strtotime($date));
    }

    private static function mergeArrayWithValueOfSecondArray($arr1, $arr2){
        $arr3 = array();
        foreach ($arr1 as $key => $value){
            if(array_key_exists($key, $arr2)){
                $arr3[$key] = $arr2[$key];
            }else{
                $arr3[$key] = $value;
            }
        }
        return $arr3;
    }

    private static function removeHoursLessThanNowAndCrowded($allBooks, $date){
        $now = date('H');
        $arr = array();
        foreach($allBooks as $key => $value){
            if(self::checkIfDateIsGreaterThanToday($date)){
                if($value < env('MAXIMUM_BOOKS_PER_HOUR')){
                    $arr[$key] = $value;
                }
            }else{
                if($key > $now && $value < env('MAXIMUM_BOOKS_PER_HOUR')){
                    $arr[$key] = $value;
                }
            }
            
        }
        return $arr;
    }

    private static function checkIfDateIsGreaterThanToday($date, $format = 'Y-m-d'){
        $date_now = date("Y-m-d");
        $date = \DateTime::createFromFormat($format, $date)->format('Y-m-d');
        
        if($date > $date_now){
            return true;
        }
    }

    /* NEW BOOKING */

    public static function checkIfHourIsAllowedToDate($hour, $date){
        $dayWeek = self::returnNameOfDayWeek($date);
        $allAvailableBooks = self::$avaiableHours[($dayWeek < 1) ? 0 : 1];
        return array_key_exists($hour, $allAvailableBooks);
    }

    public static function newBooking($data){
        //Add New Booking
        return $bookID = self::addNewBookAndReturnBook($data);
    }

    private static function getUserIDWithToken($userToken){
        $userID = User::where('nm_token', $userToken)->pluck('id_user')->toArray();
        return $userID[0];
    }

    private static function addNewBookAndReturnBook($data){
        try{

            $codeBook = rand(10000,99999);

            $book = new Book();
            $book->id_user = self::getUserIDWithToken($data['user_token']);
            $book->book_code = $codeBook;
            $book->nr_clients = $data['qtd_pessoas'];
            $book->nm_event = self::$allowedEvents[$data['tipo_evento']];
            $book->nm_local = self::$allowedPlaces[$data['local']];
            $book->is_active = 1;
            $book->dt_dateevent = $data['data'].' '.$data['hour'].':00:00';
            $book->dt_datecreated = date_create()->format('Y-m-d H:i:s');
            $book->save();

            return response()->json(['success' => true, 'code_book' => $codeBook], 200);
        
        }catch(\Illuminate\Database\QueryException $e){ 
            return response()->json(['errors' => true, 'message' => 'Algo de errado aconteceu, recarregue a página ou tente novamente em alguns minutos.'], 422);
        }
    }

}