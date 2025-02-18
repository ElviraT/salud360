<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MedicalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\registroController;
use App\Http\Controllers\Admin\Reportes\ReportePagosController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PlanController;
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
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
    // CRUD MEDICAL
    Route::get('/medicals', [MedicalController::class, 'index'])->name('medicals.index');
    Route::post('/medicals/store', [MedicalController::class, 'store'])->name('medicals.store');
    Route::get('/medicals/{medical}/edit', [MedicalController::class, 'edit'])->name('medicals.edit');
    Route::put('/medicals/update/{medical}', [MedicalController::class, 'update'])->name('medicals.update');
    Route::delete('/medicals/destroy/{medical}', [MedicalController::class, 'destroy'])->name('medicals.destroy');
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

    // REPORTES
    Route::get('/reportes-pagos', [ReportePagosController::class, 'index'])->name('report.pagos')->middleware(CheckPlan::class);
    Route::post('/actualizarStatus/{id}', [ReportePagosController::class, 'actualizarStatus'])->name('actualizar.status')->middleware(CheckPlan::class);
});
