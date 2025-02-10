<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon; // Importa Carbon para trabajar con fechas

class CheckPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Verifica si el usuario está autenticado
        if (!auth()->check()) {
            return redirect('/login'); // Redirige a la página de inicio de sesión
        }

        $user = auth()->user();

        // 2. Verifica si el usuario tiene una fecha de corte válida

        if (!$user->plan_expires_at) {
            Toastr::error(__('No tienes un plan asignado.'), 'error');
            return redirect('/inicio');
        }

        // 3. Verifica si la fecha de corte es posterior a la fecha actual
        $fechaCorte = Carbon::parse($user->plan_expires_at);
        if ($fechaCorte->isPast()) {
            Toastr::error(__('Tu plan ha expirado.'), 'error');
            return redirect('/inicio');
        }

        return $next($request);
    }
}