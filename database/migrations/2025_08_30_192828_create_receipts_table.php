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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $table->timestamp('emission_date')->nullable();
            $table->string('access_key')->nullable()->unique();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('total_discount', 10, 2)->nullable();
            $table->decimal('total_taxes', 10, 2)->nullable();
            $table->json('raw_data')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('receipts');
    }
};
