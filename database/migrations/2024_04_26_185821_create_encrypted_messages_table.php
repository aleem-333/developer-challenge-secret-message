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
        Schema::create('encrypted_messages', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->string('recipient')->unique();
            $table->string('decryption_key');
            $table->timestamp('expires_at')->nullable();
            $table->boolean('read_once')->default(false);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encrypted_messages');
    }
};
