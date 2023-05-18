<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nm_name' => substr($this->faker->name, 0, 100),
            'nm_cellphone' => '21993181612',
            'nm_email' => $this->faker->safeEmail,
            'txt_message' => substr($this->faker->text, 0, 1000),
            'dt_datecreated' => date('Y-m-d H:i:s'),
        ];
    }
}
