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
        Schema::create('chooses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('create_user_id');
            $table->foreign('create_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('datetime');
            $table->string('pembahasan');
            $table->string('semester');
            $table->string('image')->nullable();
            $table->string('keterangan');
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->string('no_pdf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chooses');
    }
};
