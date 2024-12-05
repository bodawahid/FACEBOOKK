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
        Schema::create('following', function (Blueprint $table) {
            $table->id();
            $table->foreignId('following_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('follower_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('followed_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('following');
    }
};
