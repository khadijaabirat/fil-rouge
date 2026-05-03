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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
         $table->decimal('amount',12, 2);
        $table->string('message')->nullable();
        $table->dateTime('donationDate')->useCurrent();
        $table->boolean('isAnonymous')->default(false);
        $table->enum('status', ['PENDING', 'VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT','FAILED'])->default('PENDING');
       $table->foreignId('donator_id')->nullable()->constrained('users')->nullOnDelete();
        $table->foreignId('project_id')->constrained('projects');
        $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
