<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Schedules;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
                'exists:patient_families,id',
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

            return response()->json([
                'success' => true,
                'message' => 'Cita creada con éxito',
                'appointment' => $appointment,
                'invoice' => $invoice
            ], 201);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Error al crear la cita',
                'error' => $e->getMessage()
            ], 500);
        }
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

    public function getDoctorModality(int $doctorId)
    {
        $schedules = Schedules::where('doctor_id', $doctorId)->get();

        $modalities = $schedules->pluck('type_consulting')->unique()->values();
        // $days = $schedules->pluck('day_id')->unique()->values();
        // // Concatenar las horas de inicio y fin
        // $times = $schedules->map(function ($schedule) {
        //     return $schedule->start_hour . ' - ' . $schedule->end_hour;
        // })->unique()->values();

        return response()->json([
            'modalities' => $modalities,
            // 'days' => $days,
            // 'times' => $times,
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

    public function getDoctorSchedules1(int $doctorId, string $modality = null)
    {
        $schedules = Schedules::where('doctor_id', $doctorId);

        if ($modality) {
            $schedules = $schedules->where('type_consulting', $modality);
        }

        $schedules = $schedules->get();

        $response = [];

        if ($modality) {
            $response['days'] = $schedules->pluck('day_id')->unique()->values();
            $response['times'] = $schedules->map(function ($schedule) {
                return $schedule->start_hour . ' - ' . $schedule->end_hour;
            })->unique()->values();
        } else {
            $response['modalities'] = $schedules->pluck('type_consulting')->unique()->values();
        }

        return response()->json($response);
    }
}