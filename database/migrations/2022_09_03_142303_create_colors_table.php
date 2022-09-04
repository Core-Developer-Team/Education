<?php

use App\Models\Color;
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
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('role_id')->constrained();
            $table->timestamps();
        });
        Color::updateOrCreate([
            'name' => '#FF5733',
            'role_id' => 1,
        ]);
        Color::updateOrCreate([
            'name' => '#7B3121',
            'role_id' => 2,
        ]);
        Color::updateOrCreate([
            'name' => '#A7264B',
            'role_id' => 3,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colors');
    }
};
