<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->unique();
            $table->nullableMorphs('model');
            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('file_name');
            $table->unsignedBigInteger('size');
            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();
            $table->unsignedInteger('order_column')->nullable()->index();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imports');
    }
};
