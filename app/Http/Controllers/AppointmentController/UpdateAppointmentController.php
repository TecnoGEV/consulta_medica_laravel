<?php

namespace App\Http\Controllers\AppointmentConroller;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;

class StoreAppointmentController extends Controller
{

    function __invoke(UpdateAppointmentRequest $request, Appointment $appointment): JsonResponse
    {
        if(strlen($appointment->id) === 0) {
            return response()->statusCode(JsonResponse::HTTP_NOT_FOUND);
        }

        $appointment->updateOrFail($request->all());

        if ($appointment->saveOrFail()) {
            return response()->statusCode(JsonResponse::HTTP_OK);
        }
        
        return response()->statusCode(JsonResponse::HTTP_NOT_MODIFIED);
    }
}
