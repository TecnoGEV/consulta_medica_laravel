<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AppointmentController extends Controller
{
    public function __construct(private Appointment $appointment)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->appointment->paginate('20', ['*'], 'page'));
    }

    public function store(StoreAppointmentRequest $request) : Response
    {
        $this->appointment->create($request->all());
        return response(
            status:Response::HTTP_CREATED, 
            headers:[
                'Location' => url("/api/appointments/{$this->appointment->id}")
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/api/appointments/{appointment}",
     *     summary="Get appointment by ID",
     *     description="Returns a single appointment",
     *     operationId="getAppointmentById",
     *
     *     @OA\Parameter(
     *         name="appointment",
     *         in="path",
     *         description="ID of the appointment",
     *         required=true,
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Appointment located successfully",
     *
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/Appointment"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Appointment not found",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *               @OA\Schema(
     *                  schema="Error",
     *                  type="object",
     *                  title="Error",
     *                  properties={
     *
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

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): JsonResponse
    {
        $appointment->updateOrFail($request->all());
        $appointment->push();
        return response()->json($appointment, status:JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(Appointment $appointment): Response
    {
        $appointment->deleteOrFail();
        return response(status:Response::HTTP_NO_CONTENT);
    }
}
