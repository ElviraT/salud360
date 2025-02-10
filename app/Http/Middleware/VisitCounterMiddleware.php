<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class VisitCounterMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        // Verificar si la solicitud actual corresponde a una visita única
        $ipAddress = $request->getClientIp();
        $userAgent = $request->userAgent();
        $visitExists = DB::table('visits')
            ->where('ip_address', $ipAddress)
            ->where('user_agent', $userAgent)
            ->whereDate('created_at', today())
            ->exists();

        // Si se trata de una visita única, registrar la visita en la base de datos
        if (!$visitExists) {
            DB::table('visits')->insert([
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'created_at' => now(),
            ]);
        }

        // Continuar con la siguiente solicitud en la cadena
        return $next($request);
    }
}