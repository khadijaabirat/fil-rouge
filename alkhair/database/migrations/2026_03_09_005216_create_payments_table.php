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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('transactionId')->unique();
        $table->enum('paymentMethod', ['ONLINE', 'MANUAL']);
        $table->string('paymentReceipt')->nullable();
        $table->decimal('amount',10,2);
         $table->enum('status', ['SUCCESS', 'FAILED', 'PENDING'])->default('PENDING');

         $table->foreignId('donation_id')->constrained('donations')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
