<?php

namespace App\Providers;

use App\Console\Commands\UpdateSheetEnviosVisitasCommand;
use App\Console\Commands\UpdateSheetTrafegoPagoLeadsCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class TarefaAgendadaProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Schedule $schedule): void
    {
        // Exemplo de uma tarefa agendada
       // $schedule->command('emails:send')->dailyAt('13:00');

        // Outro exemplo: rodar um job a cada minuto
       // $schedule->job(new \App\Jobs\MeuJob)->everyMinute();

       // $schedule->command(UpdateSheetData::class)->daily();

       
       //$schedule->command(UpdateSheetEnviosVisitas::class)->everyMinute(); // executa a cada 1 minuto
       
       $schedule->command(UpdateSheetEnviosVisitasCommand::class)->everyMinute(); // executa a cada 3 horas

       $schedule->command(UpdateSheetTrafegoPagoLeadsCommand::class)->everyMinute(); // executa a cada 1 minutos
    }
}
