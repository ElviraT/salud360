<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\HealthInformation;
use App\Models\InformedConsent;
use App\Models\MaritalStatus;
use App\Models\Patient;
use App\Models\Role;
use App\Models\Sex;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            $patients = Patient::all(); // Example relationships
            $marital = MaritalStatus::all();
            $users = User::with('roles')->get(); // Example relationship
        } else {
            $patients = Patient::where('created_by', Auth::user()->id)->get();
            $marital = MaritalStatus::all();
            $users = '';
        }
        $roles = Role::where('name', '<>', 'SuperAdmin')->get();
        $sexes = Sex::all();
        return view('admin.users.patient.index', compact('patients', 'roles', 'marital', 'sexes', 'users'));
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $cliente = User::find($request['created_by']); // Use find for direct ID lookup, faster than where()->first()

            if (!$cliente) { // Handle the case where the creating user doesn't exist
                DB::rollBack();
                Toastr::error(__('The creating user was not found.'), 'Error');
                return back()->withInput(); // Or redirect as needed
            }


            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'created_by' => $request['created_by'],
                'plan_id' => $cliente->plan_id, // Access properties directly with ->
                'plan_expires_at' => $cliente->plan_expires_at,
                'active' => 1,
            ]);

            $user->assignRole(5);

            $paciente = Patient::create([
                'user_id' => $user->id,
                'marital_id' => $request['marital_id'],
                'sexes_id' => $request['sexes_id'],
                'Date_of_birth' => $request['Date_of_birth'],
                'dni' => $request['dni'],
                'ocupation' => $request['ocupation'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'active' => 1,
                'created_by' => $request['created_by'],
            ]);

            Contact::create([ // Directly create and avoid unnecessary variable assignment
                'patient_id' => $paciente->id,
                'name' => $request['namec'],
                'email' => $request['emailc'],
                'phone' => $request['phonec'],
                'address' => $request['addressc'],
            ]);

            HealthInformation::create([ // Directly create
                'patient_id' => $paciente->id,
                'blood_group' => $request['blood_group'],
                'allergies' => $request['allergies'],
                'medical_condition' => $request['medical_condition'],
                'medication' => $request['medication'],
            ]);

            $telemedicine = $request['telemedicine'] === 'on' ? 1 : 0; // Ternary operator for concise conditional
            $data_collection = $request['data_collection'] === 'on' ? 1 : 0; // Ternary operator

            InformedConsent::create([ // Directly create, corrected variable name
                'patient_id' => $paciente->id,
                'telemedicine' => $telemedicine,
                'data_collection' => $data_collection,
            ]);

            DB::commit();
            Toastr::success(__('Added successfully'), __('Patient') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'Error');
        }
        return to_route('patients');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
