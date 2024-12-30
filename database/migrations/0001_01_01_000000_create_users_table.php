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
            $table->id()->length(5); // Assuming you want a 5-digit length
            $table->string('name', 100); // Limiting the name field to 100 characters
            $table->string('email', 100)->unique(); // Limiting the email field to 100 characters
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100); // Limiting the password field to 100 characters
            $table->enum('role', ['admin', 'mahasiswa', 'dosen', 'teknisi']);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 100)->primary(); // Limiting the email field to 100 characters
            $table->string('token', 100); // Limiting the token field to 100 characters
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id', 100)->primary(); // Limiting the id field to 100 characters
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
