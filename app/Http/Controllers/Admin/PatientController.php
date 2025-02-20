<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaritalStatus;
use App\Models\Patient;
use App\Models\Role;
use App\Models\Sex;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            $patients = Patient::all(); // Example relationships
            $marital = MaritalStatus::all();
            $users = User::with('roles')->get(); // Example relationship
        } else {
            $patients = Patient::where('created_by', Auth::user()->id)->get();
            $marital = MaritalStatus::all();
            $users = '';
        }
        $roles = Role::where('name', '<>', 'SuperAdmin')->get();
        $sexes = Sex::all();
        return view('admin.users.patient.index', compact('patients', 'roles', 'marital', 'sexes', 'users'));
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
        //
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
}