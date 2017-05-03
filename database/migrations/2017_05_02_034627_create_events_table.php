<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('team_id')->index();
            $table->string('type'); // online, irl, hybrid
            $table->string('name'); // of event
            $table->text('description');
            $table->string('location_name'); // name of venue
            $table->text('location_address');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->dateTime('open_date_time'); // gates open | online bidding starts ...
            $table->dateTime('drawing_date_time'); // when the drawing for winners happens

            $table->text('terms_and_conditions'); // is this necessary?
            // needs pricing defined.
            // if using pre printed tickets, needs to know the range of the tickets?
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
