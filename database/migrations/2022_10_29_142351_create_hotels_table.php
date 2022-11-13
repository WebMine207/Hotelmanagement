<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('listing_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->string('description', 2000)->nullable();
            $table->integer('guest')->nullable();
            $table->string('house_rules', 2000)->nullable();
            $table->string('refunds')->nullable();
            $table->string('cancellation')->nullable();
            $table->integer('monthly_price_factor')->nullable();
            $table->integer('weekly_discount')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('cleaning_fee', 10, 2)->nullable();
            $table->decimal('weekend_base_price', 10, 2)->nullable();
            $table->decimal('extra_person_fee', 10, 2)->nullable();
            $table->decimal('guests_included_in_regular_fee', 10, 2)->nullable();
            $table->decimal('security_deposit_fee', 10, 2)->nullable();
            $table->decimal('pet_fee', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('city_tax', 10, 2)->nullable();
            $table->decimal('good_and_service_tax', 10, 2)->nullable();
            $table->string('common_note')->nullable();
            $table->string('main_image')->nullable();
            $table->string('emmunities', 2000)->nullable();
            $table->integer('bedrooms')->default(0);
            $table->decimal('bathrooms', 10, 2)->default(0);
            $table->integer('beds')->default(0);
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
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
        Schema::dropIfExists('hotels');
    }
}
