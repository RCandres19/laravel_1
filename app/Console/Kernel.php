<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Defina los comandos de la consola de su aplicación.
     *
     * @var array
     */
    protected $commands = [
        // Agrega aquí tus comandos personalizados
        \App\Console\Commands\CleanExpiredTokens::class,
    ];

    /**
     * Defina la programación de los comandos.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Programa el comando de limpieza de tokens expirados
        $schedule->command('tokens:clean-expired')->daily(); // Eliminar tokens expirados todos los días
    }

    /**
     * Registre los comandos de la consola.
     *
     * @return void
     */
    protected function commands()
    {
        // Carga todos los comandos en la carpeta de comandos
        $this->load(__DIR__.'/Commands');

        // Registra las rutas de comandos definidas en routes/console.php
        require base_path('routes/console.php');
    }
}
