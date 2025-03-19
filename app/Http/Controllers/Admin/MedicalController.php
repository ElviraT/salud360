<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Day;
use App\Models\Doctor;
use App\Models\Schedules;
use App\Models\Speciality;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            $medicals = Doctor::with(['clinic', 'user'])->get(); // Example relationships
            $users = User::with('roles')->get(); // Example relationship
            $specialities = Speciality::all(); // Likely doesn't need eager loading
            $clinics = Clinic::with('doctors')->get(); // Example relationship
        } else {
            $medicals = Doctor::where('created_by', Auth::user()->id)->with(['clinic', 'user'])->get();
            $users = User::where('created_by', Auth::user()->id)->with('roles')->get();
            $specialities = Speciality::all(); // Likely doesn't need eager loading
            $clinics = Clinic::where('user_id', Auth::user()->id)->with('doctors')->get();
        }

        return view('admin.users.medical.index', compact('medicals', 'users', 'specialities', 'clinics'));
    }

    public function store(Request $request)
    {
        try {
            Doctor::create($request->post());
            Toastr::success(__('Added successfully'), __('Medical') . ': ' . $request->input('first_name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $medical)
    {
        $medical->load(['schedules' => function ($query) {
            $query->with('day'); // Carga la relación day dentro de schedules
        }, 'speciality', 'user']);

        return response()->json($medical);
    }

    public function edit($id)
    {
        $medical = Doctor::find($id);
        if (Auth::user()->hasRole('SuperAdmin')) {
            $specialities = Speciality::all(); // Likely doesn't need eager loading
            $clinics = Clinic::with('doctors')->get(); // Example relationship
        } else {
            $specialities = Speciality::all(); // Likely doesn't need eager loading
            $clinics = Clinic::where('user_id', Auth::user()->id)->with('doctors')->get();
        }
        $schedules = Schedules::where('doctor_id', $medical->id)->get();
        $days = Day::all();
        $doctor_id = $id;
        return view('admin.users.medical.edit', compact('medical', 'specialities', 'clinics', 'schedules', 'days', 'doctor_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        try {
            $medical = Doctor::find($id);
            $medical->update($request->post());
            Toastr::success(__('Updated registration'), __('Medical') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return redirect()->back();
    }

    public function destroy(Doctor $medical)
    {
        $medical->delete();
        Toastr::success(__('Registry successfully deleted'), 'Delete');
        return redirect()->back();
    }
}
