<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpaceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('host_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('parking_id');
            $table->string('amount');
            $table->string('transfer_id');
            $table->string('destination_account');
            $table->text('date')->nullable();
            $table->text('hours')->nullable();
            $table->string('arrival_time')->nullable();
            $table->string('departure_time')->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('weeks')->nullable();
            $table->string('days')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('space_bookings');
    }
}
