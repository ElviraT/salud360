<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ArchivoTrait
{
    protected function uploadArchive($imagen, $carpeta)
    {
        if ($imagen != '') {
            $imageName = $imagen->getClientOriginalName();
            $path = 'public/' . $carpeta . $imageName; // Ajusta la ruta
            $ruta = $carpeta . $imageName;
            Storage::makeDirectory('public/' . $carpeta); // No necesitas permisos 0755
            $this->_deleteArchivo($path); // Si _deleteArchivo está en el Trait, usa $this->_deleteArchivo
            Storage::disk('local')->put($path, file_get_contents($imagen));
            return $ruta;
        }
    }

    // Si _deleteArchivo está en el controlador principal, muévelo al Trait
    private function _deleteArchivo($path)
    {
        // Lógica para borrar el archivo anterior si existe
        if (Storage::disk('local')->exists($path)) {
            Storage::disk('local')->delete($path);
        }
    }
}