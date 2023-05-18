<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('id_book');
            $table->integer('id_user');
            $table->string('book_code', 5);
            $table->integer('nr_clients');
            $table->string('nm_event', 20);
            $table->string('nm_local', 20);
            $table->boolean('is_active');
            $table->dateTime('dt_dateevent');
            $table->dateTime('dt_datecreated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
