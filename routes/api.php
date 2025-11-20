<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngController;
use App\Http\Controllers\TsuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PasswordController;


Route::middleware("auth:sanctum")->group(function() {
    Route::get("/user", function(Request $request) {
        return $request->user();
    });


    // Procesos para el usuario
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/change-password", [PasswordController::class, "update"]);
    Route::post("/archivo/referencia/store", [ArchivoController::class, "referenciaStore"]);
    Route::post("/archivo/memoria/store", [ArchivoController::class, "memoriaStore"]);
    Route::post("/arc hivo/memoria/destroy/{id}", [ArchivoController::class, "memoriaDestroy"]);
    Route::post("/archivo/comprobante/destroy/{id}", [ArchivoController::class, "comprobanteDestroy"]);
    Route::post("/archivo/imagen/destroy/{id}", [ArchivoController::class, "imagenDestroy"]);
    Route::post("/archivo/comprobante/store", [ArchivoController::class, "comprobanteStore"]); 
    Route::post("/archivo/imagen/store", [ArchivoController::class, "imagenStore"]); 
    Route::post("/proceso/encuesta/update", [ProcesoController::class, "updateEncuesta"]);
    
});

Route::apiResource("/students/tsu", TsuController::class);
Route::apiResource("/students/ing", IngController::class);
Route::apiResource("/students/all",StudentController::class);
Route::apiResource("/admins", AdminController::class);

// Autenticación 
Route::post("/login", [AuthController::class, "login"]);