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
        Schema::create('photo_watches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photo_id')->constrained('photos')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('watched_at')->useCurrent();
            $table->string('user_agent')->nullable();
            $table->string('ip_address')->nullable();
            $table->unique(['photo_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_watches');
    }
};
