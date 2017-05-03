<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventItemTicketBucketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_item_ticket_buckets', function (Blueprint $table) {
            $table->increments('id'); // bucket_id
            $table->unsignedInteger('event_id')->index();
            $table->unsignedInteger('item_id')->index();
            $table->unsignedInteger('ticket_id')->index();
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
        Schema::drop('event_item_ticket_buckets');
    }
}
