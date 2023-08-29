<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('userables', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs('userable');
            $table->json('options')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'userable_id', 'userable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('userables');
    }
};
