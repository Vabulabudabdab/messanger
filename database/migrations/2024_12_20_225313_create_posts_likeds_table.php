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
        Schema::create('posts_likeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->references('id');
            $table->foreignId('user_id')->constrained('users')->references('id');
            $table->boolean('like')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_likeds');
    }
};
