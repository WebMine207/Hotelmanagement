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
            $table->string('slug')->unique()->nullable();
            $table->string('feature_image')->nullable()->default(null);
            $table->string('name')->nullable();
            $table->string('description', 2000)->nullable();
            $table->tinyInteger('hotel_type')->default('3')->comment("1=Motel,2=Resort,3=Boutique");
            $table->integer('total_room')->nullable();
            $table->integer('guest')->nullable();
            $table->integer('bedrooms')->default(0);
            $table->decimal('bathrooms', 10, 2)->default(0);
            $table->integer('beds')->default(0);
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->decimal('security_deposit_fee', 10, 2)->nullable();
            $table->decimal('convenience_charge', 10, 2)->nullable();
            $table->decimal('extra_person_fee', 10, 2)->nullable();
            $table->decimal('weekend_base_price', 10, 2)->nullable();
            $table->decimal('good_and_service_tax', 10, 2)->nullable();
            $table->decimal('cancelation_charge', 10, 2)->nullable();
            $table->string('refunds')->nullable();
            $table->string('cancellation')->nullable();
            $table->string('common_note')->nullable();
            $table->tinyInteger('status')->default('1')->comment("1=Active,2=In-Active");
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
