<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hoy = Carbon::now();
        $cincoDiasAtras = $hoy->copy()->subDays(4);
        $visitsData = DB::table('visits')
            ->selectRaw('DATE(created_at) AS date, COUNT(DISTINCT id) AS visits')
            ->whereBetween('created_at', [$cincoDiasAtras, $hoy])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $chartData = json_encode($visitsData);
        return view('admin.inicio.index', compact('chartData'));
    }
}