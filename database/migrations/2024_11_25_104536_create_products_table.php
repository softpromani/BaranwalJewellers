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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('images')->nullable();
            $table->decimal('packing_charge')->nullable();
            $table->string('hallmarking_charge')->nullable();
            $table->string('price')->nullable();
            $table->string('making_charge')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('discount')->nullable();
            $table->string('stock')->nullable();
            $table->string('tax')->nullable();
            $table->string(column: 'metal_id')->nullable();
            $table->string('carat_id')->nullable();
            $table->string('weight_number')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
