<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Badge;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('image', 2048);
            $table->timestamps();
        });
        DB::table('badges')->insert([
            'name'        => 'Low Level',
            'description' => 'New Users',
            'image'       =>  '/storage/badges/celebrity.svg',
        ]);
        DB::table('badges')->insert([
            'name'        => 'Medium level',
            'description' => 'Those who are take or give total 20+ problems or solution 
            completely.',
            'image'        =>  '/storage/badges/hotshot.svg',
        ]);
        DB::table('badges')->insert([
            'name'        => 'Top rated',
            'description' => 'who are complete 70+ solutions completely with 4.7+ ratings.',
            'image'       =>  '/storage/badges/featured.svg',
        ]);
        DB::table('badges')->insert([
            'name'        => 'Teaching Assistant',
            'description' => 'who are reviewed 50+ reported problems ',
            'image'       =>  '/storage/badges/master.svg',
        ]);
        DB::table('badges')->insert([
            'name'        => 'Verified',
            'description' => 'Who solve 100+ solutions with average 4+ Ratings ',
            'image'       =>  '/storage/badges/verified.svg',
        ]);
        DB::table('badges')->insert([
            'name'        => 'Blocked',
            'description' => 'Those Who are blocked by admin',
            'image'       =>  '/storage/badges/elite.svg',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badges');
    }
};
