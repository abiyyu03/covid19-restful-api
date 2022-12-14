<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * Auth Area
 */
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    /**
     * Patients
    */
    Route::get('/patients',[PatientController::class,'index']);

    Route::post('/patients',[PatientController::class,'store']);

    Route::put('/patients/{id}',[PatientController::class,'update']);

    Route::delete('/patients/{id}',[PatientController::class,'destroy']);

    Route::get('/patients/{id}',[PatientController::class,'show']);

    Route::get('/patients/search/{name}',[PatientController::class,'search']);

    // Route::get('/patients/status/{status}',[PatientController::class,'status']);

    Route::get('/patients/status/{positive}',[PatientController::class,'positive']);

    Route::get('/patients/status/{recovered}',[PatientController::class,'recovered']);

    Route::get('/patients/status/{dead}',[PatientController::class,'dead']);

});