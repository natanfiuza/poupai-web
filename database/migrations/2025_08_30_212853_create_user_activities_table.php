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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('route', 255)->default('')->collation('utf8mb4_unicode_ci')->comment('Registra a rota em que o usuario acessou no sistema');
            $table->string('ip', 255)->default('')->collation('utf8mb4_unicode_ci');
            $table->boolean('is_ajax')->default(false)->comment('Verdadeiro caso a requisição foi por ajax');
            $table->string('method', 255)->default('')->collation('utf8mb4_unicode_ci')->comment('Registra qual foi o method da requisicao');
            $table->timestamp('accessed_at')->nullable(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('restrict');

            $table->comment('Registra as atividades dos usuarios');
            $table->collation = 'utf8mb4_unicode_ci';
            $table->engine    = 'InnoDB';

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('user_activities');
    }
};
