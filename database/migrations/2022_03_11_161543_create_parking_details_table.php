<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('host_id');
            $table->string('title');
            $table->text('description');
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->enum('will_host_greet', ['yes', 'no', 'other']);
            $table->enum('has_surveillance', ['yes', 'no']);
            $table->enum('price_type', ['hourly', 'daily', 'weekly']);
            $table->string('base_price');
            $table->string('session_start')->nullable();
            $table->string('session_end')->nullable();
            $table->string('earliest_reservation')->nullable();
            $table->string('lastest_reservation')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parking_details');
    }
}
