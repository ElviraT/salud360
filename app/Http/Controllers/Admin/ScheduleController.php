<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Schedules;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Almacenar el usuario autenticado para evitar llamadas repetidas

        if ($user->hasAnyRole(['SuperAdmin', 'Admin'])) {
            // Carga ansiosa para evitar el problema N+1 (si usas relaciones en tu vista)
            $schedules = Schedules::with(['doctor', 'day'])->paginate(10); // Paginación para grandes cantidades de registros
        } else {
            // Validar y sanear el ID del doctor
            $doctor_id = request('id'); // Usar la función request() de Laravel para obtener datos de la request
            if (!is_numeric($doctor_id) || $doctor_id <= 0) { // Validar que sea un número positivo
                abort(400, 'ID de doctor inválido.'); // Manejar el error de ID inválido
            }
            $schedules = Schedules::where('doctor_id', $doctor_id)->with(['doctor', 'day'])->paginate(10); // Paginación

            //Si el usuario no tiene permiso para ver los horarios, puedes devolver una vista de error o redirigir
            if ($schedules->isEmpty() && !$user->hasRole(['SuperAdmin', 'Admin'])) {
                abort(403, 'No tienes permiso para ver este horario.'); // Ejemplo: error 403
            }
        }

        $days = Day::all(); // Probablemente no necesite eager loading ni paginación, a menos que tengas MUCHOS días.

        // Pasar el ID del doctor a la vista (si es necesario)
        $doctor_id = request('id'); // Usar request() para consistencia

        return view('admin.schedules.index', compact('days', 'schedules', 'doctor_id'));
    }

    public function store(Request $request)
    {
        try {
            $resultado = ($request->post());
            Schedules::create($resultado);

            Toastr::success(__('added successfully'),  __('shedule'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return redirect()->back();
    }
    public function edit(string $id)
    {
        $shedule = Schedules::find($id);
        return response()->json($shedule);
    }

    public function update(Request $request, string $id)
    {
        $input = $request->all();
        try {
            $shedule = Schedules::find($id);
            $shedule->update($input);

            Toastr::success(__('Updated registration'),  __('Shedule'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedules $shedule)
    {
        $shedule->delete();
        Toastr::success(__('Registration Successfully Disabled'), 'Disabled');
        return redirect()->back();
    }
}
