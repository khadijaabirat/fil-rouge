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
           $table->decimal('goalAmount', 12, 2);
            $table->decimal('currentAmount', 12, 2)->default(0);
            $table->string('videoUrl')->nullable();
             $table->json('images')->nullable();
            $table->dateTime('startDate');
            $table->dateTime('endDate');
            $table->enum('status',['OPEN','CLOSED','COMPLETED','SUSPENDED'])->default('OPEN');
            $table->foreignId('association_id')->constrained('users');
            $table->foreignId('category_id')->constrained('categories');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
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
