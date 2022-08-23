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
        Schema::create('bookorder_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bookorder_id')->constrained();
            $table->foreignId('book_id')->constrained();
            $table->string('book_name');
            $table->double('price');
            $table->integer('book_quantity');
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
        Schema::dropIfExists('bookorder_details');
    }
};
