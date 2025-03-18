<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserToken;
use Carbon\Carbon;

class CleanExpiredTokens extends Command
{
    /**
     * El nombre y la firma del comando.
     *
     * @var string
     */
    protected $signature = 'tokens:clean-expired';

    /**
     * La descripción del comando.
     *
     * @var string
     */
    protected $description = 'Eliminar tokens expirados de la base de datos';

    /**
     * Ejecuta el comando.
     *
     * @return void
     */
    public function handle()
    {
        $deletedCount = UserToken::where('expires_at', '<', Carbon::now())->delete();
        $this->info("Eliminados {$deletedCount} tokens expirados.");
    }
}
