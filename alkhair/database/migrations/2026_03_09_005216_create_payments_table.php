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
        $table->string('transactionId')->unique()->nullable();
        $table->enum('paymentMethod', ['ONLINE', 'MANUAL']);
        $table->string('paymentReceipt')->nullable();
       $table->decimal('amount', 15, 2);
$table->dateTime('paymentDate')->nullable();
         $table->enum('status', ['SUCCESS', 'FAILED', 'PENDING'])->default('PENDING');
         $table->foreignId('donation_id')->constrained('donations')->onDelete('cascade');;
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
