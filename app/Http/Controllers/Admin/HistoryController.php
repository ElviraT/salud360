<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalHistory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HistoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required|exists:types_backgrounds,id',
            'description' => 'required|string',
            'related_medications' => 'nullable|string',
            'related_allergies' => 'nullable|string',
            'notes' => 'nullable|string',
            'patient_id' => 'required|integer',
            'patient_type' => 'required|string',
        ]);
        try {
            $antecedente = new MedicalHistory();
            $antecedente->patient_id = $request->patient_id;
            $antecedente->patient_type = $request->patient_type;
            $antecedente->type_id = $request->type_id;
            $antecedente->description = Crypt::encryptString($request->description);
            $antecedente->diagnosis_date = $request->diagnosis_date;
            $antecedente->related_medications = $request->related_medications;
            $antecedente->related_allergies = $request->related_allergies;
            $antecedente->notes = Crypt::encryptString($request->notes);
            $antecedente->save();
            Toastr::success(__('Added successfully'), __('Medical History'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return redirect()->back();
    }
}