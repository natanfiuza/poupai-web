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
        Schema::table('category_users', function (Blueprint $table) {
            $table->unsignedBigInteger('category_default_id')->after('user_id')->nullable()->comment('Identificacao da categoria padrao que criou esta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_users', function (Blueprint $table) {
            // $table->dropColumn('category_default_id');
        });
    }
};
