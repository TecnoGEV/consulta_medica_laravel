<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;

class AppointmentController extends Controller
{

    public function index() : JsonResponse
    {
        return response()->json(Appointment::all(), JsonResponse::HTTP_OK);
    }

    public function store(StoreAppointmentRequest $request): JsonResponse
    {
        $appointment = Appointment::createOrFail($request->all());
        return response()
            ->statusCode(JsonResponse::HTTP_CREATED)
            ->header('Location', url("/api/appointments/{$appointment->id}"));
    }                                           

    public function show(Appointment $appointment): JsonResponse
    {
        return response()->json($appointment, JsonResponse::HTTP_NO_CONTENT);
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): JsonResponse
    {
        $appointment->updateOrFail($request->all());
        $appointment->saveOrFail();
        return response()->json($appointment, JsonResponse::HTTP_OK);
    }

    public function destroy(Appointment $appointment): JsonResponse
    {
        $appointment->deleteOrFail();
        return response()->statusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
