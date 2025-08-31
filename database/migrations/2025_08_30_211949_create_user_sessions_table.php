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
        Schema::create('user_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('Identifica o usuario que fez o login');
            $table->char('uuid', 36)->collation('utf8mb4_unicode_ci')->comment('Chave de identificacao da sessao');
            $table->string('start', 50)->collation('utf8mb4_unicode_ci')->comment('Timestamp de quado o usuario logou no sistema.');
            $table->unsignedBigInteger('expire')->nullable()->default()->comment('Timestamp de quado expira para o usuario.');
            $table->string('last_activity', 50)->nullable()->collation('utf8mb4_unicode_ci')->comment('Timestamp da ultima interacao do usuario com o sistema.');
            $table->string('exit_session', 50)->nullable()->collation('utf8mb4_unicode_ci')->comment('Timestamp de quando o usuario clicou para deslogar do sistema.');
            $table->timestamps();

            $table->comment('Registra as sessoes abertas ao usuario logado no sistema.');
            $table->collation = 'utf8mb4_unicode_ci';
            $table->engine    = 'InnoDB';

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sessions');
    }
};
