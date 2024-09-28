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
        Schema::create('photo_comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('photo_id')->nullable()->constrained('photos')->onDelete('cascade');
            $table->tinyInteger('status')->default(1);
             //comment_reply
             $table->unsignedBigInteger('parent_comment_id')->nullable();
             $table->foreign('parent_comment_id')->references('id')->on('photo_comments')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['photo_id']);
            $table->dropForeign(['parent_comment_id']);
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('photo_comments');
    }
};
