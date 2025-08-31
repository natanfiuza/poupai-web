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
        Schema::create('user_session_apps', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('Identifica o usuario que fez o login');
            $table->uuid('uuid')->comment('Chave de identificacao da sessao');
            $table->string('start', 50)->comment('Timestamp de quado o usuario logou no sistema.');
            $table->string('expire', 50)->comment('Timestamp de quado expira para o usuario.');
            $table->string('last_activity', 50)->nullable()->comment('Timestamp da ultima interacao do usuario com o sistema.');
            $table->string('exit_session', 50)->nullable()->comment('Timestamp de quando o usuario clicou para deslogar do sistema.');
            $table->string('os_name')->comment('Nome do sistema operacional do aplicativo ex: Android, iOS');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_session_apps');
    }
};
