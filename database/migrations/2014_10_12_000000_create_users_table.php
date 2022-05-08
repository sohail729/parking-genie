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
            $table->bigIncrements('id');
            $table->enum('type', ['super','admin','user', 'host'])->default('user');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('country')->nullable();
            $table->string('municipality')->nullable();
            $table->string('address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('postal')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('stripe_connect_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('social_id')->nullable();
            $table->string('social_type')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
