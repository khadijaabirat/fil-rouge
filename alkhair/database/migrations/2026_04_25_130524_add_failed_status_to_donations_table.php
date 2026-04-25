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
        // Modifier l'enum pour ajouter FAILED
        \DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('PENDING', 'VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT', 'FAILED') DEFAULT 'PENDING'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Retour à l'enum original
        \DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('PENDING', 'VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT') DEFAULT 'PENDING'");
    }
};
