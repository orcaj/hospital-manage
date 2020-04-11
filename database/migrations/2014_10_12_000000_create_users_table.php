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
            $table->id();
            $table->string('name', 200);
            $table->string('email', 200)->unique();
            $table->timestamp('email_verified_at', 200)->nullable();
            $table->string('password', 200);
            $table->rememberToken();
            $table->timestamps();
            // $table->id();
            // // $table->bigIncrements('id');
            // $table->string('name', 155);
            // $table->string('email', 155)->unique();
            // $table->string('type', 155);
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password', 155);
            // $table->string('status', 155)->default('published');
            // $table->date('status_date')->nullable();
            // $table->rememberToken();
            // $table->timestamps();
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
