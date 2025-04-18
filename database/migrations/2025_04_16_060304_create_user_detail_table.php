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
        Schema::create('user_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('gender',10)->nullable();
            
        });

        Schema::create('user_location', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('city',255)->nullable();
            $table->string('country',255)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_detail');
        Schema::dropIfExists('user_location');
    }
};
