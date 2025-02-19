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
        Schema::create('trafego_pago_leads', function (Blueprint $table) {
            $table->id();
            $table->string('unidade')->nullable();
            $table->string('data')->nullable();
            $table->string('semana')->nullable();
            $table->string('meta_gasto_original')->nullable();
            $table->string('meta_gasto')->nullable();
            $table->string('valor_gasto')->nullable();
            $table->string('status')->nullable();
            $table->string('impressoes')->nullable();
            $table->string('clique_no_link')->nullable();
            $table->string('leads')->nullable();
            $table->string('valor_do_lead')->nullable();
            $table->string('acumulado_meta')->nullable();
            $table->string('acumulado_gasto')->nullable();
            $table->string('diferenca')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trafego_pago_leads');
    }
};
