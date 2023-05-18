<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Contact;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(12)->create();
        Book::factory(6)->create();
        Contact::factory(4)->create();
    }
}
