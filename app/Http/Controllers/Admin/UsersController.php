<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Traits\ArchivoTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    use ArchivoTrait;

    public function index()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            $users = User::all();
        } else {
            $users = User::where('created_by', Auth::user()->id)->get();
        }
        $roles = Role::all();

        return view('admin.users.user.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        if (empty($request['avatar'])) {
            $foto = '';
        } else {
            $foto = $this->uploadArchive($request['avatar'], 'avatar/');
        }

        try {
            $cliente = User::where('id', $request['created_by'])->first();
            $data = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'created_by' => $request['created_by'],
                'avatar' => $foto,
                'plan_id' => $cliente['plan_id'],
                'plan_expires_at' => $cliente['plan_expires_at'],
                'active' => 1,

            ];
            $user = User::create($data);
            $user->assignRole($request['roles']);

            Toastr::success(__('added successfully'),  __('User') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        if (empty($request['avatar'])) {
            $foto = '';
        } else {
            $foto = $this->uploadArchive($request['avatar'], 'avatar/');
        }

        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'created_by' => $request['created_by'],
            'avatar' => $foto,
            'active' => 1,

        ];
        if (!empty($data['password'])) {
            $data['password'] = $data['password'];
        } else {
            $data = Arr::except($data, array('password'));
        }
        $resultado = array_merge($data);
        try {
            $user = User::find($id);
            $user->update($resultado);
            if ($request['roles'] != '') {
                DB::table('model_has_roles')->where('model_id', $id)->delete();
                $user->assignRole($request->input('roles'));
            }
            Toastr::success(__('Updated registration'),  __('User') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('users.index');
    }

    public function destroy(User $user)
    {
        $this->_deleteArchivo($user->avatar);
        DB::table('model_has_roles')->where('model_id', ($user->id))->delete();
        $user->delete();
        Toastr::success(__('Registry successfully deleted'), 'Delete');
        return redirect()->back();
    }
}