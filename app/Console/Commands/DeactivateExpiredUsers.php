<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DeactivateExpiredUsers extends Command
{
    protected $signature = 'users:deactivate-expired';
    protected $description = 'Desactiva usuarios con planes vencidos.';

    public function handle()
    {
        $expiredUsers = User::where('plan_expires_at', '<', Carbon::now())->get();

        foreach ($expiredUsers as $user) {
            $user->active = false; // Desactiva al usuario
            $user->save();

            $this->info("Usuario {$user->id} desactivado.");
        }

        $this->info('Tarea completada.');
    }
}