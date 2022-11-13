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
        Schema::create('hotel_booking', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hotel_id')->unsigned()->index();
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->decimal('hotel_price', 10, 2)->nullable();
            $table->integer('hotel_guest')->nullable();
            $table->decimal('weekly_discount', 10, 2)->nullable();
            $table->decimal('cleaning_fee', 10, 2)->nullable();
            $table->decimal('security_deposit_fee', 10, 2)->nullable();
            $table->decimal('pet_fee', 10, 2)->nullable();
            $table->decimal('city_tax', 10, 2)->nullable();
            $table->decimal('good_and_service_tax', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->string('listing_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_booking');
    }
};
