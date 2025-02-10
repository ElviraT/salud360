<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
// use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Clinic;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use DateInterval;
use DateTime;

class registroController extends Controller
{

    protected $redirectTo = '/inicio';

    // const UPLOAD_PATH = 'public/';
    public function uploadOne($imagen, $carpeta)
    {

        if ($imagen != '') {

            $imageName = time() . '.' . $imagen->extension();
            $path = 'public/' . $carpeta . $imageName; // Ruta dentro de storage

            // Crear la carpeta si no existe
            Storage::makeDirectory('public/' . $carpeta, 0755, true);

            // Guardar la imagen
            $img = Storage::disk('local')->put($path, file_get_contents($imagen));
            return $path;
        } else {
            return '';
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

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // dd('estoy en registro');
        $this->validator($request->all())->validate();
        try {
            DB::beginTransaction();
            $user = $this->create($request->all());
            $this->performPostRegistrationActions($user, $request);
            $this->guard()->login($user);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
        }

        return redirect($this->redirectTo);
    }
    protected function create(array $data)
    {
        $fechaActual = new DateTime(); // Obtiene la fecha actual

        $diasASumar = 7; // Cantidad de días a sumar

        $fechaActual->add(new DateInterval('P' . $diasASumar . 'D')); // Suma los días

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'plan_id' => $data['plan_id'],
            'plan_expires_at' => $fechaActual,
            'password' => Hash::make($data['password']),
        ]);
    }
    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
    protected function performPostRegistrationActions($user, $request)
    {
        // Otras acciones
        if ($request['roles'] == 'Medico') {
            $doctorrequest = [
                'user_id' => $user->id,
                'speciality_id' => $request['speciality_id'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'clinic_id' => 0,
                'professional_license' => $request['professional_license'],
                'bio' => $request['bio'],
                'active' => 1,
                'photo' => $this->uploadOne($request['photo'], 'medico/'), // Utiliza el Trait
            ];

            $cli = Doctor::create($doctorrequest);
        } elseif ($request['roles'] == 'Clinica') {
            $clinicrequest = [
                'name' => $request['name1'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'email' => $request['emailc'],
                'logo' => $this->uploadOne($request['logo'], 'logo/'), // Utiliza el Trait
                'user_id' => $user->id,
                'description' => $request['description'],
                'active' => 1,
            ];
            // dd($clinicrequest);
            $cli = Clinic::create($clinicrequest);
        }
        // Asignar rol
        $user->assignRole('Admin');
        return $cli;
    }
}