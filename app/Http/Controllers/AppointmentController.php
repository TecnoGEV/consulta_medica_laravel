<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function show(Appointment $appointment): JsonResponse
    {
        return response()->json($appointment, JsonResponse::HTTP_OK);
    }

    function update(UpdateAppointmentRequest $request, Appointment $appointment): JsonResponse
    {
        $appointment->updateOrFail($request->all());
        $appointment->saveOrFail();
        return response()->statusCode(JsonResponse::HTTP_OK);
    }

    public function destroy(Appointment $appointment): JsonResponse
    {
        $appointment->deleteOrFail();
        return response()->statusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
