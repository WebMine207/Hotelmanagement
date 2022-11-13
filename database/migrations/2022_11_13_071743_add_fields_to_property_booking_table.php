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
        Schema::table('hotel_booking', function (Blueprint $table) {
            $table->string('stripe_id')->nullable()->after('status');
            $table->string('transaction_id')->nullable()->after('stripe_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_booking', function (Blueprint $table) {
            $table->dropColumn('stripe_id');
            $table->dropColumn('transaction_id');
        });
    }
};
