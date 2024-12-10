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
        Schema::create('metal_models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable;
            $table->string('image')->nullable;
            $table->string('price')->nullable;
            $table->string('status')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metal_models');
    }
};
