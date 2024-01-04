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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longtext('info');
            $table->string('image');
            $table->geometry('location')->nullable();
            $table->string('area');
            $table->integer('seats');
            $table->double('priceusd');
            $table->double('pricesy');
            $table->enum('status',['res_open','res_over','ongoing','over','canceled'])->default('res_open');
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->timestamp('start_date');
            $table->timestamp('expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
