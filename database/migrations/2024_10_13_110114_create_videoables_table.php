<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videoables', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('video_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->morphs('videoable');
            $table->integer('order_column')->nullable();
            $table->json('options')->nullable();
            $table->timestamps();
            $table->unique(['video_id', 'videoable_id', 'videoable_type']);
            $table->index(['videoable_id', 'videoable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videoables');
    }
};
