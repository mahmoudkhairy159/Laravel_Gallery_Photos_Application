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
        Schema::create('photo_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('photo_id')->nullable()->constrained('photos')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['photo_id', 'user_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_likes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['photo_id']);
        });
        Schema::dropIfExists('photo_likes');
    }
};
