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
        Schema::table('payment_logs', function (Blueprint $table) {
            $table->integer('seller_id')->after('pay_by')->nullable();
            $table->integer('amount_seller')->after('amount')->nullable();
            $table->integer('amount_admin')->after('amount_seller')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_logs', function (Blueprint $table) {
            $table->dropColumn('seller_id');
            $table->dropColumn('amount_seller');
            $table->dropColumn('amount_admin');
        });
    }
};
