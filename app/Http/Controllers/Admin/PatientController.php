<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentStatus;
use App\Models\Contact;
use App\Models\Currency;
use App\Models\Doctor;
use App\Models\File;
use App\Models\Folder;
use App\Models\HealthInformation;
use App\Models\InformedConsent;
use App\Models\MaritalStatus;
use App\Models\Patient;
use App\Models\PatientFamily;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
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
        // Carga el paciente con sus relaciones (usuario, contacto, información de salud)
        $patient = Patient::with(['user', 'contact', 'healthInformation'])->find($id);

        // Verifica si el paciente existe
        if (!$patient) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }

        // Obtiene todos los estados civiles
        $marital = MaritalStatus::all();

        // Obtiene todos los tipos de antecedentes
        $tiposAntecedentes = TypesBackground::all();

        // Obtiene todos los sexos
        $sexes = Sex::all();

        // Obtiene todos los archivos asociados al paciente
        $files = File::where('patient_id', $id)->get();

        // Obtiene las citas del paciente actual
        $appointments = $this->getPatientAppointments($id);

        // Obtiene todos los pacientes (principales y familiares) del usuario logueado
        $allPatients = $this->getAllUserPatients();
        $medicals = Doctor::where('created_by', $patient->created_by)->get();
        $appointmentstatus = AppointmentStatus::all();
        $paymentStatus = PaymentStatus::all();
        $methodPay = PaymentMethod::all();
        $currency = Currency::all();

        // Retorna la vista con todos los datos necesarios
        return view('admin.users.patient.edit', [
            'patient' => $patient,
            'user' => $patient->user,
            'contact' => $patient->contact,
            'healthInformation' => $patient->healthInformation,
            'marital' => $marital,
            'tiposAntecedentes' => $tiposAntecedentes,
            'sexes' => $sexes,
            'files' => $files,
            'appointments' => $appointments,
            'allPatients' => $allPatients,
            'medicals' => $medicals,
            'appointmentstatus' => $appointmentstatus,
            'paymentStatus' => $paymentStatus,
            'methodPay' => $methodPay,
            'currency' => $currency,
        ]);
    }

    /**
     * Obtiene las citas asociadas a un paciente específico.
     *
     * @param int $patientId ID del paciente.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getPatientAppointments(int $patientId)
    {
        return Appointment::select([
            'appointments.id',
            'appointments.date',
            'appointments.time',
            'appointments.type',
            'doctors.name as doctor_name',
            'appointment_statuses.name as status_name',
            'appointment_statuses.color as status_color',
            'invoices.invoice_number',
            'invoices.subtotal',
            'currencies.simbol as currency_symbol',
            'payment_statuses.name as payment_status'
        ])
            ->leftJoin('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->leftJoin('appointment_statuses', 'appointments.appointment_statuses_id', '=', 'appointment_statuses.id')
            ->leftJoin('invoices', 'invoices.appointment_id', '=', 'appointments.id')
            ->leftJoin('currencies', 'invoices.currency_id', '=', 'currencies.id')
            ->leftJoin('payment_statuses', 'invoices.payment_status_id', '=', 'payment_statuses.id')
            ->where('appointments.patient_id', $patientId)
            ->orderBy('appointments.date', 'DESC')
            ->orderBy('appointments.time', 'DESC')
            ->get();
    }

    /**
     * Obtiene todos los pacientes (principales y familiares) del usuario logueado.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getAllUserPatients()
    {
        $userId = Auth::user()->id;

        if (Auth::user()->hasRole('SuperAdmin')) {
            // Si es SuperAdmin, obtiene todos los pacientes
            $mainPatients = Patient::all();
            $familyPatients = PatientFamily::all();
        } else {
            // Si no es SuperAdmin, obtiene solo los pacientes del usuario
            $mainPatients = Patient::where('created_by', $userId)->get();
            $patientIds = $mainPatients->pluck('id');
            $familyPatients = PatientFamily::whereIn('patient_id', $patientIds)->get();
        }

        // Combina los pacientes principales y familiares en una sola colección
        $allPatients = $mainPatients->concat($familyPatients);

        // Formatea los resultados para incluir nombre e ID
        $formattedPatients = $allPatients->map(function ($patient) {
            if ($patient instanceof Patient) {
                // Obtiene el nombre del paciente principal desde la tabla users
                $user = User::find($patient->user_id);
                $mainPatientName = $user ? $user->name : 'Usuario no encontrado';

                return [
                    'id' =>  $patient->id, // Prefijo 'P-' para pacientes principales
                    'name' => $mainPatientName, // Usamos el nombre del usuario
                    'type' => 'Principal',
                ];
            } else {
                // Obtiene el ID del paciente principal desde la tabla patients
                $mainPatientId = $patient->patient_id;
                // Obtiene el paciente principal
                $mainPatient = Patient::find($mainPatientId);
                // Obtiene el nombre del usuario desde la tabla users
                $user = User::find($mainPatient->user_id);
                $mainPatientName = $user ? $user->name : 'Usuario no encontrado';

                return [
                    'id' =>  $patient->id, // Prefijo 'F-' para pacientes familiares
                    'name' => $patient->name . ' (Familiar de ' . $mainPatientName . ')',
                    'type' => 'Familiar',
                ];
            }
        });

        return $formattedPatients;
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