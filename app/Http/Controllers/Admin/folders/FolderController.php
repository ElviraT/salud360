<?php

namespace App\Http\Controllers\Admin\folders;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        try {
            $folder = Folder::create($request->post());
            Toastr::success(__('Added successfully'), __('Folder') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $folders = Folder::findOrFail($id);
        $subfolders = $folders->childfolder;
        $files = $folders->file;
        return view('admin.users.patient.folders.show', compact('folders', 'subfolders', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $folder = Folder::find($id);
        return response()->json($folder);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        try {
            $folder = Folder::find($id);
            $folder->name = $request->input('name');
            $folder->save();
            Toastr::success(__('Updated registration'), __('Folder') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
        $folder->delete();
        Toastr::success(__('Registry successfully deleted'), 'Delete');
        return redirect()->back();
    }

    public function sub_folder(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $data = [
            'name' => $request->name,
            'id_parent_folder' => $request->id,
            'id_user' => Auth::user()->id
        ];
        try {
            $folder = Folder::create($data);
            Toastr::success(__('Added successfully'), __('Folder') . ': ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return redirect()->back();
    }
}