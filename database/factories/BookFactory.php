<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BookFactory extends Factory
{
    private static $allowedPeople = array(2, 4, 6, 8, 12);
    private static $allowedEvents = array(1 => 'festa', 2 => 'aniversario', 3 => 'evento', 4 => 'confraternizacao', 5 => 'outro');
    private static $allowedPlaces = array(1 => 'varanda', 2 => 'salao');
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => rand(1, 12),
            'book_code' => rand(10009, 99999),
            'nr_clients' => self::$allowedPeople[rand(0, 4)],
            'nm_event' => self::$allowedEvents[rand(1, 5)],
            'nm_local' => self::$allowedPlaces[rand(1, 2)],
            'is_active' => 1,
            'dt_dateevent' => date('Y-m-d 22:00:00'),
            'dt_datecreated' => date('Y-m-d H:i:s'),
        ];
    }
}
