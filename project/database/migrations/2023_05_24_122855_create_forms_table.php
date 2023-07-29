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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('input')->nullable();
            $table->string('textarea')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('select')->nullable();
            $table->string('checkbox')->nullable();
            $table->string('radio')->nullable();
            $table->integer('page_id')->unsigned();
            $table->boolean('isActive')->default(1);
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
        Schema::dropIfExists('forms');
    }
};
