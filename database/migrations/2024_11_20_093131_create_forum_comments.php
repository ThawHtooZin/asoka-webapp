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
        Schema::create('forum_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Who wrote the comment
            $table->unsignedBigInteger('forum_id'); // The forum post the comment belongs to
            $table->unsignedBigInteger('parent_comment_id')->nullable(); // For replies, will be null for top-level comments
            $table->text('comment'); // The content of the comment
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('forum_id')->references('id')->on('forums')->onDelete('cascade');
            $table->foreign('parent_comment_id')->references('id')->on('forum_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
