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
        Schema::create('translaters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('info');
            $table->enum('gender',['male','female']);
            $table->string('languages_spoken');
            $table->enum('status',['available','taken','unavailable'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translaters');
    }
};
