<?php

namespace App\Http\Controllers\Admin\Reportes;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateInterval;

class ReportePagosController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('details', 'transactionable');

        $tipoPago = request('tipo_pago');
        $status = request('status');

        // Filtros
        if ($request->has('fecha_inicio')) {
            $rangoFechas = $request->input('fecha_inicio');
            $fechas = explode(' - ', $rangoFechas);
            $fechaInicio = $fechas[0];
            $fechaFin = $fechas[1];
            $fechaInicioObj = DateTime::createFromFormat('m/d/Y', $fechaInicio);
            $fechaFinObj = DateTime::createFromFormat('m/d/Y', $fechaFin);

            $fechaInicioFormateada = $fechaInicioObj->format('Y-m-d');
            $fechaFinFormateada = $fechaFinObj->format('Y-m-d');

            $query->whereBetween('transaction_date', [$fechaInicioFormateada, $fechaFinFormateada]);
        }

        if (isset($request->tipo_pago) && $request->tipo_pago != 'Todos') {
            $query->where('transactionable_type', 'LIKE', '%' . $request->tipo_pago . '%');
        }

        if (isset($request->status) && $request->status != 'Todos') {
            $query->where('payment_status', $request->status); // Asegúrate de que el tipo de dato coincida
        }

        $pagos = $query->get();

        return view('admin.reportes.pagos.index', compact('pagos'));
    }

    public function actualizarStatus(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $transaction = Transaction::findOrFail($id); // Usa findOrFail para lanzar una excepción si no existe
            $transaction->payment_status = $request->status;
            $transaction->save();

            $relatedModel = $transaction->transactionable;

            if ($relatedModel) {
                // Usa un switch para mayor legibilidad y eficiencia
                switch (true) {
                    case $relatedModel instanceof Plan:

                        $relatedModel->status = $request->status;
                        // Actualizar el usuario (una sola vez después del switch)
                        if ($request->status === 'Aprobado') { // Solo si el pago se aprueba
                            $fechaActual = new DateTime();
                            $diasASumar = $relatedModel->duration;
                            $fechaExpiracion = $fechaActual->add(new DateInterval('P' . $diasASumar . 'D'));

                            $user = User::findOrFail($transaction->user_id); // Usa $transaction->user_id directamente
                            $user->plan_id = $relatedModel->id;
                            $user->active = 1;
                            $user->plan_expires_at = $fechaExpiracion;
                            $user->save(); // Guarda los cambios del usuario aquí, una sola vez
                        }
                        break;
                        // case $relatedModel instanceof Gasto:
                        //     $relatedModel->status = $request->status;
                        //     break;
                        // case $relatedModel instanceof Factura:
                        //     $relatedModel->estado_pago = $request->status;
                        //     break;
                }
                $relatedModel->save();
            }

            // Actualiza el monto en el banco (optimizado)
            if ($request->status === 'Aprobado') {  // Comparación estricta (===)
                Bank::where('id', $transaction->bank_id)->increment('amount', $transaction->amount);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            // Log del error para depuración

            return redirect()->back()->with('error', 'Error al actualizar: ' . $th->getMessage()); // Ejemplo
        }

        return redirect()->back();
    }
}