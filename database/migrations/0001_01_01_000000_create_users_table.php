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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'first_name')->nullable();
            $table->string(column: 'last_name')->nullable();
            $table->string(column: 'name')->nullable();
            $table->string('email')->nullable();
            $table->string(column: 'phone')->unique();
            $table->string(column: 'city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string(column: 'pincode')->nullable();
            $table->string('image')->nullable();
            $table->longText('about')->nullable();
            $table->string(column: 'company')->nullable();
            $table->string('profession')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->text('fcm_token')->nullable();
            $table->tinyInteger('is_phone_verified')->default(1);
            $table->text(column: 'address')->nullable();
            $table->text('token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_admin')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
