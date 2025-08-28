<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\FaseAgendamientoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\AtencionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\OrigenController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\AgendamientoController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\OperativoController;

/*
|--------------------------------------------------------------------------
| Rutas públicas mínimas
|--------------------------------------------------------------------------
| - Login para obtener token Sanctum
| - Verificación de email (link firmado)
*/
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // marca email como verificado
    return response()->json(['message' => 'Email verificado']);
})->middleware(['signed', 'throttle:6,1'])->name('verification.verify');


/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
| Requieren:
|  - auth:sanctum (token)
|  - verified (email verificado)
|  - module:<slug> (autorización por módulo)
*/
Route::middleware(['auth:sanctum'])->group(function () {
    // Logout y reenviar verificación
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // (Opcional) Perfil del usuario autenticado
    Route::get('/me', function (Request $request) {
        $user = $request->user()->load('roles');
        return new \App\Http\Resources\UserResource($user);
    });

    // Todo lo demás requiere email verificado
    Route::middleware(['verified'])->group(function () {

        // -------- Usuarios (registro interno) --------
        Route::apiResource('users', UserController::class)->middleware('module:usuarios');

        // -------- Roles + Módulos --------
        Route::apiResource('roles', RoleController::class)->middleware('module:roles');
        Route::post('roles/{role}/modules/sync', [RoleController::class, 'syncModules'])->middleware('module:roles');
        Route::post('roles/{role}/modules/{module}', [RoleController::class, 'attachModule'])->middleware('module:roles');
        Route::delete('roles/{role}/modules/{module}', [RoleController::class, 'detachModule'])->middleware('module:roles');

        // -------- Módulos --------
        Route::apiResource('modules', ModuleController::class)->middleware('module:modulos');

        // -------- Catálogos --------
        Route::apiResource('especies', EspecieController::class)->middleware('module:pacientes');
        Route::apiResource('fases-agendamiento', FaseAgendamientoController::class)->middleware('module:fases-agendamiento');
        Route::apiResource('tipos-pago', TipoPagoController::class)->middleware('module:tipos-pago');
        Route::apiResource('origenes', OrigenController::class)->middleware('module:calendario');

        // -------- Entidades principales --------
        Route::apiResource('pacientes', PacienteController::class)->middleware('module:pacientes');
        Route::apiResource('tutores', TutorController::class)->middleware('module:tutores');
        Route::apiResource('atenciones', AtencionController::class)->middleware('module:clinica');

        Route::apiResource('productos', ProductoController::class)->middleware('module:productos');
        Route::apiResource('servicios', ServicioController::class)->middleware('module:servicios');
        Route::apiResource('pagos', PagoController::class)->middleware('module:pagos');

        Route::apiResource('gestiones', GestionController::class)->middleware('module:calendario');
        Route::apiResource('uploads', UploadController::class)->middleware('module:uploads');
        Route::apiResource('operativos', OperativoController::class)->middleware('module:operativos');

        // -------- Agendamientos + vínculos M:M --------
        Route::apiResource('agendamientos', AgendamientoController::class)->middleware('module:calendario');

        // Productos del agendamiento
        Route::post('agendamientos/{agendamiento}/productos', [AgendamientoController::class, 'attachProducto'])->middleware('module:calendario');
        Route::delete('agendamientos/{agendamiento}/productos/{producto}', [AgendamientoController::class, 'detachProducto'])->middleware('module:calendario');

        // Servicios del agendamiento
        Route::post('agendamientos/{agendamiento}/servicios', [AgendamientoController::class, 'attachServicio'])->middleware('module:calendario');
        Route::delete('agendamientos/{agendamiento}/servicios/{servicio}', [AgendamientoController::class, 'detachServicio'])->middleware('module:calendario');

        // Pagos del agendamiento
        Route::post('agendamientos/{agendamiento}/pagos', [AgendamientoController::class, 'attachPago'])->middleware('module:calendario');
        Route::delete('agendamientos/{agendamiento}/pagos/{pago}', [AgendamientoController::class, 'detachPago'])->middleware('module:calendario');
    });
});
