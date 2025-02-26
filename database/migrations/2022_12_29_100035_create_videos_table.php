<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('model');
            $table
                ->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('prefixed_id')->unique();
            $table->json('name');
            $table->json('content')->nullable();
            $table->json('summary')->nullable();
            $table->json('titles')->nullable();
            $table->string('season')->nullable()->index();
            $table->string('episode')->nullable()->index();
            $table->string('part')->nullable()->index();
            $table->boolean('adult')->default(false)->index();
            $table->float('snapshot')->nullable();
            $table->string('state')->index();
            $table->timestamp('released_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
