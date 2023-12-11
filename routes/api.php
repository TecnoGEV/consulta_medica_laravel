<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SpecializationController;
use App\Models\Consultation;
use App\Models\FollowUp;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/appointments',     AppointmentController::class);
Route::apiResource('/attendances',      AttendanceController::class);
Route::apiResource('/clinics',          ClinicController::class);
Route::apiResource('/consultations',    ConsultationController::class);
Route::apiResource('/diagnoseis',       DiagnosisController::class);
Route::apiResource('/doctors',          DoctorController::class);
Route::apiResource('/exams',            ExamController::class);
Route::apiResource('/followups',        FollowUpController::class);
Route::apiResource('/laboratories',     LaboratoryController::class);
Route::apiResource('/patienties',       PatientController::class);
Route::apiResource('/reports',          ReportController::class);
Route::apiResource('/specializations',  SpecializationController::class);
