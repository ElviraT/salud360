<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Service;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('SuperAdmin')) {
            // Superadmin: ve todos los servicios de todas las clínicas
            $services = Service::all();
            $clinics = Clinic::all();
        } elseif ($user->hasRole('Admin')) {
            // Administrador de clínica: ve solo sus servicios
            $services = Service::where('clinic_id', $user->id)->get();
            $clinics = Clinic::where('user_id', $user->id)->get();
        } elseif ($user->hasRole('Medico')) {
            // Usuario dependiente: ve los servicios de su clínica
            $services = Service::where('clinic_id', $user->created_by)->get();
            $clinics = Clinic::where('user_id', $user->created_by)->get();
        } else {
            // Manejar otros roles o usuarios sin rol
            $services = collect(); // Colección vacía
            $clinics = collect(); // Colección vacía
        }

        return view('admin.services.index', compact('services', 'clinics'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'duration_hours' => 'nullable|integer|min:0',
            'duration_minutes' => 'nullable|integer|min:0|max:59',
            // ...otros campos de validación
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->filled('duration_hours') || $request->filled('duration_minutes')) {
                $totalMinutes = ($request->duration_hours ?? 0) * 60 + ($request->duration_minutes ?? 0);
                $request->merge(['duration' => $totalMinutes]);
            }
        });

        $validator->validate();
        try {
            Service::create($request->except(['duration_hours', 'duration_minutes']));

            Toastr::success(__('added successfully'),  __('Service') . ' ' . $request->name);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('services');
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return response()->json($service);
    }

    public function update(Request $request, Service $service)
    {
        $validator = Validator::make($request->all(), [
            'duration_hours' => 'nullable|integer|min:0',
            'duration_minutes' => 'nullable|integer|min:0|max:59',
            // ...otros campos de validación
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->filled('duration_hours') || $request->filled('duration_minutes')) {
                $totalMinutes = ($request->duration_hours ?? 0) * 60 + ($request->duration_minutes ?? 0);
                $request->merge(['duration' => $totalMinutes]);
            }
        });

        try {
            $validator->validate();
            $service->update($request->except(['duration_hours', 'duration_minutes']));
            Toastr::success(__('updated successfully'), __('Service') . ' ' . $request->name);
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'Error');
        }

        return to_route('services');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        Toastr::success(__('Registry successfully deleted'), 'Delete');
        return redirect()->back();
    }
}
