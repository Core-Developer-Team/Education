<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('f_user_id');
            $table->unsignedBigInteger('t_user_id');
            $table->foreignId('req_solution_id')->constrained();
            $table->foreignId('request_id')->constrained();
            $table->integer('rating');
            $table->string('description');
            $table->timestamps();

            $table->foreign('f_user_id')->references('id')->on('users');
            $table->foreign('t_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
