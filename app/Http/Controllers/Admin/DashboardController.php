<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientFamily;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = 0;
        $medical = 0;
        $patient = 0;
        $patientF = 0; // Inicializamos PatientFamily a 0

        if (Auth::user()->hasRole('SuperAdmin')) {
            $user = User::where('id', '<>', 1)->where('active', 1)->count();
            $medical = Doctor::count();
            $patient = Patient::count();
            $patientF = PatientFamily::count(); // Contamos todos los PatientFamily para SuperAdmin
        } else {
            $userId = Auth::user()->id;

            $patientIds = Patient::where('created_by', $userId)->pluck('id');
            $patient = $patientIds->count();
            $patientF = PatientFamily::whereIn('patient_id', $patientIds)->count();

            $user = User::where('created_by', $userId)->count();
            $medical = Doctor::where('created_by', $userId)->count();
        }

        $total_patient = $patient + $patientF;
        return view('admin.inicio.index', compact('chartData', 'user', 'medical', 'total_patient'));
        // return view('admin.inicio.index', compact('chartData'));
    }
}
