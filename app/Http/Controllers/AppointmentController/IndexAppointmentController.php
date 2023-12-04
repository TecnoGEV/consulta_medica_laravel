<?php

namespace App\Http\Controllers\AppointmentConroller;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;


class IndexAppointmentController extends Controller
{

    function __invoke(): JsonResponse
    {
        return response()->json(Appointment::all(), JsonResponse::HTTP_OK);
    }
}
