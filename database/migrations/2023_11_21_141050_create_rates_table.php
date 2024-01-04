<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rates', function (Blueprint $table) {
                $table->id();
                $table->tinyInteger('stars');
                $table->longText('body');
                $table->unsignedBigInteger('trip_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->boolean('approved');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
