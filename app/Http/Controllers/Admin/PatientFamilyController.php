<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientFamily;
use App\Models\Relationship;
use App\Models\Sex;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PatientFamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patient_id = request('id');
        $families = PatientFamily::where('patient_id', $patient_id)->get();
        $sexes = Sex::all();
        $relation = Relationship::all();
        return view('admin.users.patient.family.index', compact('families', 'sexes', 'relation', 'patient_id'));
    }


    public function store(Request $request)
    {
        try {
            PatientFamily::create($request->post());
            Toastr::success(__('Added successfully'), __('Family') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return redirect()->back();
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
        $family = PatientFamily::find($id);
        return response()->json($family);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $family = PatientFamily::find($id);
            $family->update($request->post());
            Toastr::success(__('Updated registration'), __('Family') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatientFamily $family)
    {
        $family->delete();
        Toastr::success(__('Registry successfully deleted'), 'Delete');
        return redirect()->back();
    }
}