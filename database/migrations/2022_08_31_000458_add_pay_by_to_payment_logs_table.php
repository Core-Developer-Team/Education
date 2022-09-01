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
            $table->integer('pay_by')->after('request_id')->unsigned()->nullable(); //auth id
            $table->string('pay_for')->after('pay_by')->nullable(); //pay for which purbpose ie['request','resource'] etc.
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
            $table->dropColumn('pay_by');
            $table->dropColumn('pay_for');
        });
    }
};
