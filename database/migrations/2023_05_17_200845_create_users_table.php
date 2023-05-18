<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nm_name', 100);
            $table->string('nm_cellphone', 11);
            $table->string('nm_email', 100);
            $table->longText('nm_password');
            $table->string('nm_token', 32);
            $table->dateTime('dt_datecreated');
            $table->dateTime('dt_dateupdated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
