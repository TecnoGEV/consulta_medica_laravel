<?php

namespace App\Http\Controllers\AppointmentConroller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;

class StoreAppointmentController extends Controller
{

    function __invoke(StoreAppointmentRequest $request): JsonResponse
    {
        $appointmentStore = Appointment::create($request->all());
        return response()
            ->json($appointmentStore, JsonResponse::HTTP_CREATED)
            ->header('Location', url("/api/appointments/{$appointmentStore->id}"));
    }
}
