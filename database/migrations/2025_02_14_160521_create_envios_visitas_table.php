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
        Schema::create('envios_visitas', function (Blueprint $table) {
            $table->id();
            $table->string('unidade')->nullable();
            $table->string('data')->nullable();
            $table->string('semana')->nullable();
            $table->string('meta_envios')->nullable();
            $table->string('enviados')->nullable();
            $table->string('faltou')->nullable();
            $table->string('meta_agendamentos')->nullable();
            $table->string('agendamentos')->nullable();
            $table->string('meta_visitas')->nullable();
            $table->string('visitas_realizadas')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios_visitas');
    }
};
