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
        Schema::create('disease_solutions', function (Blueprint $table) {
            $table->id();
            $table->string('disease_key')->unique();
            $table->string('disease_name');
            $table->text('cause')->nullable();
            $table->text('pesticide')->nullable();
            $table->text('watering')->nullable();
            $table->text('prevention')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disease_solutions');
    }
};
