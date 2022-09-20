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
        Schema::create('proposalreviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fr_user_id');
            $table->unsignedBigInteger('tp_user_id');
            $table->foreignId('proposal_id')->constrained();
            $table->foreignId('propsolution_id')->constrained();
            $table->integer('rating');
            $table->string('description');
            $table->timestamps();

            $table->foreign('fr_user_id')->references('id')->on('users');
            $table->foreign('tp_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposalreviews');
    }
};
