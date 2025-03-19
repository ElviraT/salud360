<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\File;
use App\Models\Folder;
use App\Models\HealthInformation;
use App\Models\InformedConsent;
use App\Models\MaritalStatus;
use App\Models\Patient;
use App\Models\Role;
use App\Models\Sex;
use App\Models\TypesBackground;
use App\Models\User;
use App\Traits\ArchivoTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    use ArchivoTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            $patients = Patient::all(); // Example relationships
            $users = User::with('roles')->get(); // Example relationship
        } else {
            $patients = Patient::where('created_by', Auth::user()->id)->get();
            $users = '';
        }
        $marital = MaritalStatus::all();
        $tiposAntecedentes = TypesBackground::all();
        $roles = Role::where('name', '<>', 'SuperAdmin')->get();
        $sexes = Sex::all();
        return view('admin.users.patient.index', compact('patients', 'roles', 'marital', 'sexes', 'users', 'tiposAntecedentes'));
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
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'Error');
        }
        return to_route('patients');
    }


    public function edit(int $id)
    {
        $patient = Patient::with(['user', 'contact', 'healthInformation'])->find($id);
        $marital = MaritalStatus::all();
        $tiposAntecedentes = TypesBackground::all();
        $sexes = Sex::all();
        if (!$patient) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }
        $files = File::where('patient_id', $id)->get();

        return view('admin.users.patient.edit', [
            'patient' => $patient,
            'user' => $patient->user,
            'contact' => $patient->contact,
            'healthInformation' => $patient->healthInformation,
            'marital' => $marital,
            'tiposAntecedentes' => $tiposAntecedentes,
            'sexes' => $sexes,
            'files' => $files,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $paciente = Patient::find($id);

            if (!$paciente) {
                DB::rollBack();
                Toastr::error(__('Patient not found.'), 'Error');
                return back()->withInput();
            }

            $userId = $paciente->user_id; // Obtiene el ID del usuario desde el paciente
            $user = User::find($userId);

            if (!$user) {
                DB::rollBack();
                Toastr::error(__('User not found.'), 'Error');
                return back()->withInput();
            }

            $user->update([
                'name' => $request['name'],
            ]);


            $paciente->update([
                'marital_id' => $request['marital_id'],
                'sexes_id' => $request['sexes_id'],
                'Date_of_birth' => $request['Date_of_birth'],
                'dni' => $request['dni'],
                'ocupation' => $request['ocupation'],
                'phone' => $request['phone'],
                'address' => $request['address'],
            ]);

            Contact::where('patient_id', $id)->update([
                'name' => $request['namec'],
                'email' => $request['emailc'],
                'phone' => $request['phonec'],
                'address' => $request['addressc'],
            ]);

            HealthInformation::where('patient_id', $id)->update([
                'blood_group' => $request['blood_group'],
                'allergies' => $request['allergies'],
                'medical_condition' => $request['medical_condition'],
                'medication' => $request['medication'],
            ]);

            $telemedicine = $request['telemedicine'] === 'on' ? 1 : 0;
            $data_collection = $request['data_collection'] === 'on' ? 1 : 0;

            InformedConsent::where('patient_id', $id)->update([
                'telemedicine' => $telemedicine,
                'data_collection' => $data_collection,
            ]);

            DB::commit();
            Toastr::success(__('Updated successfully'), __('Patient') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'Error');
        }
        return to_route('patients.edit', $id);
    }

    public function update_foto(Request $request, string $id)
    {
        $data = [];
        if ($request['avatar']) {
            $data['avatar'] = $this->uploadArchive($request->file('avatar'), 'avatar/');
        }

        try {
            DB::beginTransaction();

            $user = User::find($id);
            $user->update($data);

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'Error');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();

            $paciente = Patient::find($id);

            if (!$paciente) {
                DB::rollBack();
                Toastr::error(__('Patient not found.'), 'Error');
                return back();
            }

            $usuario = User::find($paciente->user_id);

            if (!$usuario) {
                DB::rollBack();
                Toastr::error(__('User not found.'), 'Error');
                return back();
            }

            // Eliminar las relaciones
            Contact::where('patient_id', $id)->delete();
            HealthInformation::where('patient_id', $id)->delete();
            InformedConsent::where('patient_id', $id)->delete();
            DB::table('model_has_roles')->where('model_id', $usuario->id)->delete();

            // Eliminar el paciente y el usuario
            $paciente->delete();
            $usuario->delete();

            DB::commit();
            Toastr::success(__('Patient and user deleted successfully.'), __('Success'));
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred while deleting.'), 'Error');
        }

        return back();
    }
}
