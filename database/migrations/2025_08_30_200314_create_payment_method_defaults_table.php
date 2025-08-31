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
        Schema::create('payment_method_defaults', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', [
                'card',
                'credit_card',
                'debit_card',
                'pix',
                'cash',
                'bank_transfer',
                'bank_account',
                'digital_wallet',
                'bill',
                'crypto',
                'other']);
            $table->string('icon')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_method_defaults');
    }
};
