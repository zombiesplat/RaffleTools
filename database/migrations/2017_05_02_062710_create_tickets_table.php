<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token', 32)->index(); // maybe 40?
            $table->unsignedInteger('event_id')->index();
            $table->unsignedInteger('user_id')->index(); // are patrons going to be users?
            // tracking to item used on, date used on, package purchased from,
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tickets');
    }
}
