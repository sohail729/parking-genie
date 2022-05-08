<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosting_plans', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->string('sub')->nullable();
            $table->text('description')->nullable();
            $table->string('period')->nullable();
            $table->string('stripe_prod_id');
            $table->string('stripe_price_id');
            $table->string('amount');
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosting_plans');
    }
}
