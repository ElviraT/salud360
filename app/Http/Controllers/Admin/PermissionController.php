<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(): View
    {
        $roles = Role::all();
        return view('admin.permissions.index', compact('roles'));
    }

    public function create(): View
    {
        $role = Role::where('id', $_GET['rol'])->first();
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('admin.permissions.create', compact('permission', 'role', 'rolePermissions'));
    }

    public function store(Request $request)
    {
        $role = Role::where('id', $request->rol)->first();

        $role->syncPermissions($request->permissions);

        Toastr::success(__('Added successfully'), 'Permiso');
        return to_route('permissions.index');
    }
}
