<?php

namespace App\Http\Controllers\AppointmentConroller;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;

class IndexAppointmentController extends Controller
{
    function __invoke(Appointment $appointment): JsonResponse
    {
        if(strlen($appointment->id) === 0) {
            return response()->statusCode(JsonResponse::HTTP_NOT_FOUND);
        }
        
        return response()->json($appointment, JsonResponse::HTTP_NO_CONTENT);
    }
}
   