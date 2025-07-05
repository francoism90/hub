<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('prefixed_id')->unique();
            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('name')->nullable();
            $table->text('content')->nullable();
            $table->string('kind')->nullable()->index();
            $table->string('type')->nullable()->index();
            $table->string('state')->index();
            $table->json('options')->nullable();
            $table->unsignedInteger('order_column')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('groupables', function (Blueprint $table) {
            $table
                ->foreignId('group_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->morphs('groupable');
            $table->unsignedInteger('order_column')->nullable()->index();
            $table->json('options')->nullable();
            $table->timestamps();
            $table->unique(['group_id', 'groupable_id', 'groupable_type']);
            $table->index(['groupable_id', 'groupable_type']);
            $table->index(['order_column', 'groupable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groupables');
        Schema::dropIfExists('groups');
    }
};
