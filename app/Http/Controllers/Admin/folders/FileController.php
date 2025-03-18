<?php

namespace App\Http\Controllers\Admin\folders;

use App\Http\Controllers\Controller;
use App\Models\File;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function upload(Request $request)
    {
        try {
            $file = $request->file('file');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $request->file('file')->storeAs($request->folder, $fileName, 'public');

            $files = new File();
            $files->name = $fileName;
            $files->patient_id = $request->patient_id;
            $files->save();

            Toastr::success(__('Updated registration'), __('File'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return redirect()->back();
    }

    public function destroy(File $file)
    {
        $archivo = $file->name;
        $this->_eliminarArchivo($archivo);
        $file->delete();
        Toastr::success(__('Registry successfully deleted'), 'Delete');
        return redirect()->back();
    }

    private function _eliminarArchivo($name)
    {
        $archivo =  $name;
        app(FilesystemManager::class)->disk('public')->delete($archivo);
        app(FilesystemManager::class)->disk('local')->delete($archivo);
        Storage::disk('public')->delete($archivo);
        Storage::disk('local')->delete($archivo);
    }
}