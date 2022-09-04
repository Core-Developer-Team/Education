<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('guard_name', 255);
            $table->timestamps();
        });
        Role::updateOrCreate([
            'name' => 'Admin',
            'guard_name' => 'admin',
        ]);
        Role::updateOrCreate([
            'name' => 'User',
            'guard_name' => 'user',
        ]);
        Role::updateOrCreate([
            'name' => 'Moderator',
            'guard_name' => 'Moderator',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
