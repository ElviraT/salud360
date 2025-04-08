<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentStatus;
use App\Models\Currency;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Patient;
use App\Models\PatientFamily;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\Schedules;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtiene las citas del paciente actual
        $appointments = Appointment::select([
            'appointments.id',
            'appointments.date',
            'appointments.time',
            'appointments.type',
            'doctors.name as doctor_name',
            'patients.user_id',
            'appointments.patient_family_id',
            DB::raw('CASE 
                WHEN appointments.patient_family_id <> "" THEN 
                    (SELECT CONCAT("F-", pf.id, " | ", pf.name, " (Familiar de ", u.name, ")") 
                     FROM patient_families pf
                     JOIN patients p ON pf.patient_id = p.id 
                     JOIN users u ON p.user_id = u.id
                     WHERE pf.id = appointments.patient_id)
                ELSE 
                    (SELECT CONCAT("P-", patients.id, " | ", name) FROM users WHERE id = patients.user_id)
                END as patient_name'),
            'appointment_statuses.name as status_name',
            'appointment_statuses.color as status_color',
            'invoices.invoice_number',
            'invoices.subtotal',
            'currencies.simbol as currency_symbol',
            'payment_statuses.name as payment_status'
        ])
            ->leftJoin('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->leftJoin('patients', 'appointments.patient_id', '=', 'patients.id')
            ->leftJoin('appointment_statuses', 'appointments.appointment_statuses_id', '=', 'appointment_statuses.id')
            ->leftJoin('invoices', 'invoices.appointment_id', '=', 'appointments.id')
            ->leftJoin('currencies', 'invoices.currency_id', '=', 'currencies.id')
            ->leftJoin('payment_statuses', 'invoices.payment_status_id', '=', 'payment_statuses.id')
            ->orderBy('appointments.date', 'DESC')
            ->orderBy('appointments.time', 'DESC')
            ->get();

        $allPatients = $this->getAllUserPatients();
        $medicals = Auth::user()->is_superadmin
            ? Doctor::all()
            : Doctor::where('created_by', Auth::user()->id)->get();
        $appointmentstatus = AppointmentStatus::all();
        $paymentStatus = PaymentStatus::all();
        $methodPay = PaymentMethod::all();
        $currency = Currency::all();

        return view('admin.appointments.index', compact('appointments', 'allPatients', 'medicals', 'appointmentstatus', 'paymentStatus', 'methodPay', 'currency'));
    }
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
                    'principal' => '',
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
                    'principal' => $mainPatientId,
                ];
            }
        });

        return $formattedPatients;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'type' => 'required|in:emergency,video,face,domicile',
            'date' => 'required|date',
            'hour' => 'nullable',
            'time' => 'required',
            'appointment_statuses_id' => 'required|exists:appointment_statuses,id',
            'patient_type' => ['required', Rule::in(['patient', 'family'])],
            'patient_family_id' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->input('patient_type') === 'family';
                }),
                'nullable',
                'exists:patients,id', // Solo si es familiar
            ],
            'payment_status_id' => 'required|exists:payment_statuses,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'currency' => 'required|exists:currencies,id',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Iniciar transacción de base de datos
        DB::beginTransaction();

        try {
            // Crear la cita
            // Crear la cita (solo datos relevantes)
            $appointmentData = $request->only([
                'user_id',
                'patient_id',
                'doctor_id',
                'type',
                'date',
                'hour', // Usamos hour para asignar a time
                'appointment_statuses_id',
                'patient_type',
                'patient_family_id',
            ]);

            // Asignar el valor de hour a time
            $appointmentData['time'] = $appointmentData['hour'];

            // Eliminar hour del array, ya que no es una columna de la tabla appointments
            unset($appointmentData['hour']);
            // dd($appointmentData);
            $appointment = Appointment::create($appointmentData);

            // Crear la factura
            $invoiceData = $request->only([
                'payment_status_id',
                'payment_method_id',
            ]);

            $invoiceData['user_id'] = Auth::user()->id;
            $invoiceData['patient_id'] = $request->input('patient_id');
            $invoiceData['appointment_id'] = $appointment->id;
            $invoiceData['subtotal'] = $request->input('amount');
            $invoiceData['total'] = $request->input('amount');
            $invoiceData['tax'] = 0;
            $invoiceData['invoice_date'] = now();
            $invoiceData['currency_id'] = $request->input('currency');
            $invoiceData['notes'] = 'Factura generada automáticamente';

            // Generar número de factura único
            $lastInvoice = Invoice::latest()->first();
            $lastNumber = $lastInvoice ? (int) substr($lastInvoice->invoice_number, -5) : 0;
            $invoiceData['invoice_number'] = 'INV-' . date('Y') . '-' . str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

            $invoice = Invoice::create($invoiceData);

            // Crear los ítems de la factura
            // foreach ($request->input('items') as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => 'Factura generada automáticamente',
                'quantity' => 1,
                'unit_price' => $request->input('amount'),
                'total' => $request->input('amount'),
            ]);
            // }


            // Confirmar la transacción
            DB::commit();
            Toastr::success(__('Cita creada con éxito'));
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollback();
            Toastr::error(__('Error al crear la cita'), $e->getMessage());
        }
        return redirect()->back();
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

    public function getDoctorModality(int $doctorId)
    {
        $schedules = Schedules::where('doctor_id', $doctorId)->get();
        $modalities = $schedules->pluck('type_consulting')->unique()->values();

        return response()->json([
            'modalities' => $modalities
        ]);
    }
    public function getDoctorSchedules(string $modality, int $doctorId)
    {
        $schedules = Schedules::where('doctor_id', $doctorId);
        $montoConsulta = 0;
        if ($modality) {
            $schedules = $schedules->where('type_consulting', $modality);
            $montoConsulta = Doctor::where('id', $doctorId)
                ->value("$modality");
        }

        $schedules = $schedules->get();

        // Concatenar las horas de inicio y fin
        $times = $schedules->map(function ($schedule) {
            return $schedule->start_hour . ' - ' . $schedule->end_hour;
        })->unique()->values();

        // Obtener los días únicos para la modalidad seleccionada
        $days = $schedules->pluck('day_id')->unique()->values();


        return response()->json([
            'days' => $days,
            'times' => $times,
            'montoConsulta' => $montoConsulta,
        ]);
    }
}
