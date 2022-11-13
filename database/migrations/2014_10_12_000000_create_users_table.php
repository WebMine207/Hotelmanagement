<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('first_name');
            $table->string('last_name');
            $table->bigInteger('mobile_number')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender', ['Male', 'Female','Other'])->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->datetime('subscription_ends_at')->nullable();
            $table->tinyInteger('status')->default('1')->comment("1 = Active,2 = In Active");
            $table->tinyInteger('role')->default('3')->comment("1 = Admin,2 = Hotel Manager,3 = User");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
