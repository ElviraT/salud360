<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\folders\FileController;
use App\Http\Controllers\Admin\folders\FolderController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\MedicalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PatientFamilyController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\registroController;
use App\Http\Controllers\Admin\Reportes\ReportePagosController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SpecialityController;
use App\Http\Middleware\CheckPlan;
use App\Http\Middleware\VisitCounterMiddleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// RUTAS SIN AUTENTICACIÓN
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(VisitCounterMiddleware::class);
Route::get('/exit', function () {
    return view('admin.exit');
});
Auth::routes();
Route::post('set-locale', [LanguageController::class, 'setLocale']);
Route::post('/contactanos', [HomeController::class, 'contactanos'])->name('contactanos');
Route::post('/registro', [registroController::class, 'register'])->name('registro');
Route::get('/renovar-plan', [HomeController::class, 'renovar_plan']);
// FIN
// RUTAS CON AUTENTICACIÓN
Route::group(['middleware' => ['auth']], function () {
    Route::get('/inicio', [DashboardController::class, 'index'])->name('inicio');
    Route::get('/clear-cache', function () {
        Artisan::call('optimize:clear');
        return to_route('inicio');
    })->name('limpiar');

    Route::get("meeting", [MeetingController::class, 'index'])->name('meeting')->middleware(CheckPlan::class);
    Route::post("/createMeeting", [MeetingController::class, 'createMeeting'])->name("createMeeting")->middleware(CheckPlan::class);
    Route::post("/validateMeeting", [MeetingController::class, 'validateMeeting'])->name("validateMeeting")->middleware(CheckPlan::class);
    Route::get("/meeting/{meetingId}", function ($meetingId) {
        $METERED_DOMAIN = env('METERED_DOMAIN');
        return view('admin.room.meeting', [
            'METERED_DOMAIN' => $METERED_DOMAIN,
            'MEETING_ID' => $meetingId
        ]);
    })->middleware(CheckPlan::class);
    // CRUD ROLES
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store')->middleware(CheckPlan::class);
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware(CheckPlan::class);
    Route::put('/roles/update/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware(CheckPlan::class);
    // CRUD PERMISOS
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index')->middleware(CheckPlan::class);
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware(CheckPlan::class);
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store')->middleware(CheckPlan::class);
    // CRUD USERS
    Route::get('/users', [UsersController::class, 'index'])->name('users.index')->middleware(CheckPlan::class);
    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store')->middleware(CheckPlan::class);
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit')->middleware(CheckPlan::class);
    Route::put('/users/update_foto/{user}', [PatientController::class, 'update_foto'])->name('users.update_foto')->middleware(CheckPlan::class);
    Route::put('/users/update/{user}', [UsersController::class, 'update'])->name('users.update')->middleware(CheckPlan::class);
    Route::delete('/users/destroy/{user}', [UsersController::class, 'destroy'])->name('users.destroy')->middleware(CheckPlan::class);
    // CRUD MEDICAL
    Route::get('/medicals', [MedicalController::class, 'index'])->name('medicals.index')->middleware(CheckPlan::class);
    Route::post('/medicals/store', [MedicalController::class, 'store'])->name('medicals.store')->middleware(CheckPlan::class);
    Route::get('/medicals/{medical}/show', [MedicalController::class, 'show'])->name('medicals.show')->middleware(CheckPlan::class);
    Route::get('/medicals/{medical}/edit', [MedicalController::class, 'edit'])->name('medicals.edit')->middleware(CheckPlan::class);
    Route::put('/medicals/update/{medical}', [MedicalController::class, 'update'])->name('medicals.update')->middleware(CheckPlan::class);
    Route::delete('/medicals/destroy/{medical}', [MedicalController::class, 'destroy'])->name('medicals.destroy')->middleware(CheckPlan::class);
    //HORARIOS
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules')->middleware(CheckPlan::class);
    Route::post('/schedules/store', [ScheduleController::class, 'store'])->name('schedules.store')->middleware(CheckPlan::class);
    Route::get('/schedules/{shedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit')->middleware(CheckPlan::class);
    Route::put('/schedules/update/{shedule}', [ScheduleController::class, 'update'])->name('schedules.update')->middleware(CheckPlan::class);
    Route::delete('/schedules/destroy/{shedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy')->middleware(CheckPlan::class);
    // USUARIOS PACIENTES
    Route::get('/patients', [PatientController::class, 'index'])->name('patients')->middleware(CheckPlan::class);
    Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store')->middleware(CheckPlan::class);
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit')->middleware(CheckPlan::class);
    Route::put('/patients/update/{patient}', [PatientController::class, 'update'])->name('patients.update')->middleware(CheckPlan::class);
    Route::delete('/patients/destroy/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy')->middleware(CheckPlan::class);
    // USUARIOS FAMILIARES PACIENTES
    Route::get('/patients/family', [PatientFamilyController::class, 'index'])->name('patients.family')->middleware(CheckPlan::class);
    Route::post('/patients/family/store', [PatientFamilyController::class, 'store'])->name('patients.family.store')->middleware(CheckPlan::class);
    Route::get('/patients/family/{family}/edit', [PatientFamilyController::class, 'edit'])->name('patients.family.edit')->middleware(CheckPlan::class);
    Route::put('/patients/family/update/{family}', [PatientFamilyController::class, 'update'])->name('patients.family.update')->middleware(CheckPlan::class);
    Route::delete('/patients/family/destroy/{family}', [PatientFamilyController::class, 'destroy'])->name('patients.family.destroy')->middleware(CheckPlan::class);

    Route::post('/patients/history', [HistoryController::class, 'store'])->name('patients.history')->middleware(CheckPlan::class);


    //SERVICIOS
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/update/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/destroy/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    //ESPECIALIDAD
    Route::get('/specialities', [SpecialityController::class, 'index'])->name('specialities');
    Route::post('/specialities/store', [SpecialityController::class, 'store'])->name('specialities.store');
    Route::get('/specialities/{speciality}/edit', [SpecialityController::class, 'edit'])->name('specialities.edit');
    Route::put('/specialities/update/{speciality}', [SpecialityController::class, 'update'])->name('specialities.update');
    Route::delete('/specialities/destroy/{speciality}', [SpecialityController::class, 'destroy'])->name('specialities.destroy');

    // CRUD PLANS
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::post('/plans/store', [PlanController::class, 'store'])->name('plans.store');
    Route::get('/plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    Route::put('/plans/update/{plan}', [PlanController::class, 'update'])->name('plans.update');
    Route::delete('/plans/destroy/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');
    // Route::resource('users', UserController::class);

    //PAGO DE PLAN
    Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment/{id}/consult', [PaymentController::class, 'consult']);

    // CRUD CURRENCY
    Route::get('/currencies', [CurrencyController::class, 'index'])->name('currencies.index')->middleware(CheckPlan::class);
    Route::post('/currencies/store', [CurrencyController::class, 'store'])->name('currencies.store')->middleware(CheckPlan::class);
    Route::get('/currencies/{currency}/edit', [CurrencyController::class, 'edit'])->name('currencies.edit')->middleware(CheckPlan::class);
    Route::put('/currencies/update/{currency}', [CurrencyController::class, 'update'])->name('currencies.update')->middleware(CheckPlan::class);
    Route::delete('/currencies/destroy/{currency}', [CurrencyController::class, 'destroy'])->name('currencies.destroy')->middleware(CheckPlan::class);

    // CRUD BANKS
    Route::get('/banks', [BankController::class, 'index'])->name('banks.index')->middleware(CheckPlan::class);
    Route::post('/banks/store', [BankController::class, 'store'])->name('banks.store')->middleware(CheckPlan::class);
    Route::get('/banks/{bank}/edit', [BankController::class, 'edit'])->name('banks.edit')->middleware(CheckPlan::class);
    Route::put('/banks/update/{bank}', [BankController::class, 'update'])->name('banks.update')->middleware(CheckPlan::class);
    Route::delete('/banks/destroy/{bank}', [BankController::class, 'destroy'])->name('banks.destroy')->middleware(CheckPlan::class);

    //APPOINTMENT
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/update/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/destroy/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::get('/doctor-schedules/{modality}/{doctorId}', [AppointmentController::class, 'getDoctorSchedules']);
    Route::get('/doctor-modality/{doctorId}', [AppointmentController::class, 'getDoctorModality']);
    // CRUD FILE
    Route::post('/folders/file', [FileController::class, 'upload'])->name('files.upload')->middleware(CheckPlan::class);
    Route::delete('/files/destroy/{file}', [FileController::class, 'destroy'])->name('files.destroy')->middleware(CheckPlan::class);
    // REPORTES
    Route::get('/reportes-pagos', [ReportePagosController::class, 'index'])->name('report.pagos')->middleware(CheckPlan::class);
    Route::post('/actualizarStatus/{id}', [ReportePagosController::class, 'actualizarStatus'])->name('actualizar.status')->middleware(CheckPlan::class);
});