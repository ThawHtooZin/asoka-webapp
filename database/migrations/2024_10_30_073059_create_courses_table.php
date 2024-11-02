<?php

use App\Models\CourseCategory;
use App\Models\User;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description');
            $table->string('image');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(CourseCategory::class);
            $table->text('language');
            $table->text('duration');
            $table->integer('price');
            $table->float('rating');
            $table->integer('enrolled');
            $table->text('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
