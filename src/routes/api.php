<?php
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\ConductorVehiculoController;
use App\Http\Controllers\PropietarioVehiculoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('vehiculos', VehiculoController::class);
    Route::apiResource('propietarios', PropietarioController::class);
    Route::apiResource('conductores', ConductorController::class);
    Route::apiResource('propietario-vehiculo', PropietarioVehiculoController::class);
    Route::apiResource('conductor-vehiculo', ConductorVehiculoController::class);

    Route::get(
    'vehiculos/{vehiculo}/conductores-activos',
    [ConductorVehiculoController::class, 'conductoresActivos']
);

});
