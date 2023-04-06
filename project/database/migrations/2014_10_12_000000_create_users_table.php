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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->integer('nid')->nullable();
            $table->string('address')->nullable();
            $table->text('about')->nullable();
            $table->string('image')->default('default.png');
            $table->string('email')->unique();
            $table->string('phone_no')->nullable();
            $table->string('password');
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('twofa_code')->nullable();
            $table->boolean('isTwoFa')->default(0);
            $table->boolean('sending_type')->default(0);
            $table->boolean('isDeactive')->default(0);
            $table->boolean('isOnline')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
};
