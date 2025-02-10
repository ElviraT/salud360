<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Benefits;
use App\Models\Plan;
use App\Models\PlanBenefits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            $plans = Plan::all();
            $beneficios = Benefits::all();
            return view('admin.plans.index', compact('plans', 'beneficios'));
        } else {
            return view('admin.plans.index');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:plans,name',
            'price' => 'required|unique:plans,price',
        ]);
        try {
            DB::beginTransaction();

            $plan = new Plan;
            $plan->name = $request->input('name');
            $plan->price = $request->input('price');
            $plan->duration = $request->input('duration');
            $plan->description = $request->input('description');
            $plan->save();

            $beneficios = $request->input('beneficios', []); // Asegurarse de que haya un array o un array vacío.

            // Preparar los datos para la inserción masiva
            $planBeneficiosData = array_map(function ($benefitId) use ($plan) {
                return [
                    'plan_id' => $plan->id,
                    'benefits_id' => $benefitId,
                    'created_at' => now(), // Importante: incluir timestamps
                    'updated_at' => now(), // Importante: incluir timestamps
                ];
            }, $beneficios);

            // Inserción masiva
            PlanBenefits::insert($planBeneficiosData);

            DB::commit();

            Toastr::success(__('Added successfully'), __('Plan') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return redirect()->back();
    }
    public function edit($id)
    {
        $plan = Plan::find($id);
        return response()->json([$plan]);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
        ]);
        try {
            DB::beginTransaction();

            $plan = Plan::find($id);
            $plan->name = $request->input('name');
            $plan->price = $request->input('price');
            $plan->duration = $request->input('duration');
            $plan->description = $request->input('description');
            $plan->save();

            // Eliminar los beneficios antiguos del plan
            PlanBenefits::where('plan_id', $plan->id)->delete();

            $beneficios = $request->input('beneficios', []);

            $planBeneficiosData = array_map(function ($benefitId) use ($plan) {
                return [
                    'plan_id' => $plan->id,
                    'benefits_id' => $benefitId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $beneficios);

            PlanBenefits::insert($planBeneficiosData);

            DB::commit();
            Toastr::success(__('Updated registration'), __('Plan') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return redirect()->back();
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        Toastr::success(__('Registry successfully deleted'));
        return redirect()->route('plans.index');
    }
}