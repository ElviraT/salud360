<?php

namespace App;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait
{
    const UPLOAD_PATH = 'public/';
    public function uploadOne($imagen, $carpeta)
    {

        if ($imagen != '') {
            // Ruta de la carpeta que deseas crear
            $directory = self::UPLOAD_PATH . $carpeta;

            $filename1 = date('Ymd') . '_' . $imagen->getClientOriginalName();
            $nombreImagen = str_replace(' ', '_', $filename1);
            $this->_eliminarArchivo($nombreImagen, $directory);
            $imagen->storeAs($directory, $nombreImagen);

            return $nombreImagen;
        } else {
            return false;
        }
    }
    private function _eliminarArchivo($name, $directory)
    {
        $archivo = $directory . '/' . $name;
        app(FilesystemManager::class)->disk('public')->delete($archivo);
        app(FilesystemManager::class)->disk('local')->delete($archivo);
        Storage::disk('public')->delete($archivo);
        Storage::disk('local')->delete($archivo);
    }
}