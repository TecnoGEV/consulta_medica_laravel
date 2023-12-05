<?php

namespace App\Http\Controllers\AppointmentController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class ShowAppointmentController extends Controller
{    
    /**
     * @OA\Get(
     *     path="/api/appointments/{appointment}",
     *     summary="Get appointment by ID",
     *     description="Returns a single appointment",
     *     operationId="getAppointmentById",
     *     @OA\Parameter(
     *         name="appointment",
     *         in="path",
     *         description="ID of the appointment",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Appointment located successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/Appointment"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Appointment not found",
     *         @OA\JsonContent(
     *             type="object",
     *               @OA\Schema(
     *                  schema="Error",
     *                  type="object",
     *                  title="Error",
     *                  properties={
     *                      @OA\Property(property="error", type="string", description="Error message"),
     *                      @OA\Property(property="code", type="integer", description="Error code"),
     *                  },
     *              )  
     *          )
     *     )
     * )
     */
    public function __invoke(Appointment $appointment): JsonResponse
    {
        return response()->json($appointment);
    }
}
