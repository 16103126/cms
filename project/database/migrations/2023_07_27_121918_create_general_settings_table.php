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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('dashboard_logo')->nullable();
            $table->string('website_logo')->nullable();
            $table->string('website_icon')->nullable();
            $table->string('dashboard_icon')->nullable();
            $table->text('fb_id')->nullabel();
            $table->text('fb_secret')->nullabel();
            $table->text('fb_redirect')->nullabel();
            $table->text('g_id')->nullabel();
            $table->text('g_secret')->nullabel();
            $table->text('g_redirect')->nullabel();
            $table->text('captcha_secret')->nullable();
            $table->text('captcha_sitekey')->nullable();
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
        Schema::dropIfExists('general_settings');
    }
};
