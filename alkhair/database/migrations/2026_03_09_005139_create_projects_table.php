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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->double('goalAmount');
            $table->double('currentAmount')->default(0);
            $table->string('videoUrl')->nullable();
            $table->dateTime('startDate');
            $table->dateTime('endDate');
            $table->enum('ProjectStatus',['OPEN','CLOSED','COMPLETED'])->default('OPEN');
            $table->foreignId('association_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')
      ->nullable()
      ->constrained('categories')
      ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
