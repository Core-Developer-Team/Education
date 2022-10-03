<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
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
            $table->foreignId('role_id')->constrained();
            $table->foreignId('badge_id')->constrained();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('mobile_no')->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('cover_img')->nullable();
            $table->string('uni_id')->nullable();
            $table->string('uni_name')->nullable();
            $table->integer('solutions')->default('0');
            $table->float('rating')->default('0');
            $table->enum('gender', ['0', '1'])->nullable();
            $table->enum('status',['0','1'])->default('0');
            $table->timestamp('last_seen')->nullable();
            $table->enum('department', ['0', '1', '2'])->nullable();
            $table->string('password')->nullable();
            $table->boolean('provider')->default(false);
            $table->timestamps();
        });
        User::updateOrCreate([
            'username'   => 'Admin',
            'role_id'    => '1',
            'badge_id'   => '1',
            'mobile_no'  => '03405992225',
            'uni_id'     => 'fh-6',
            'uni_name'   => 'Bangladesh University',
            'gender'     => '0',
            'department' => '0',
            'email'      => 'admin@gmail.com',
            'password'   =>  Hash::make('12345678'),
            'image'      => 'Admin/admin.jpg',
            'cover_img'  => 'Admin/admin.jpg',
        ]);
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
};
