<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialities = Speciality::all();
        return view('admin.specialities.index', compact('specialities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'fields' => 'nullable|array',
            'fields.*.name' => 'required|string',
            'fields.*.type' => 'required|string|in:text,number,select,date',
            'fields.*.options' => 'nullable|string',
            'fields.*.required' => 'nullable|boolean',
        ]);

        $fields = [];
        if ($request->has('fields')) {
            foreach ($request->fields as $field) {
                $options = isset($field['options']) ? explode(',', $field['options']) : null;
                $fields[] = [
                    'name' => $field['name'],
                    'type' => $field['type'],
                    'options' => $options,
                    'required' => isset($field['required']) && $field['required'] == 1,
                ];
            }
        }

        Speciality::create([
            'name' => $request->name,
            'fields' => json_encode($fields),
        ]);

        return to_route('specialities');
    }

    public function edit($id)
    {
        $speciality = Speciality::find($id);
        return response()->json($speciality);
    }

    public function update(Request $request, Speciality $speciality)
    {

        $request->validate([
            'name' => 'required|string',
            'fields' => 'nullable|array',
            'fields.*.name' => 'required|string',
            'fields.*.type' => 'required|string|in:text,number,select,date',
            'fields.*.options' => 'nullable|string',
            'fields.*.required' => 'nullable|boolean',
        ]);
        // dd($request);
        $fields = [];
        if ($request->has('fields')) {

            foreach ($request->fields as $field) {
                $options = isset($field['options']) ? explode(',', $field['options']) : null;
                $fields[] = [
                    'name' => $field['name'],
                    'type' => $field['type'],
                    'options' => $options,
                    'required' => isset($field['required']) && $field['required'] == 1,
                ];
            }
        }
        try {
            $speciality->update([
                'name' => $request->name,
                'fields' => json_encode($fields),
            ]);
            Toastr::success(__('Updated registration'), __('Speciality') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('specialities');
    }
}
