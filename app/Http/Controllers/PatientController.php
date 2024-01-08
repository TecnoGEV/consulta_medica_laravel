<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    public function __construct(private Patient $patient){ }

    public function index(): JsonResponse
    {
        return response()->json($this->patient->paginate('20', ['*'], 'page'));
    }

    public function store(StorePatientRequest $request): Response
    {
        $patient = $this->patient->create($request->all());
        $patient->address()->create($request->input('endereco'));

        return response(status:Response::HTTP_CREATED, headers:[
          'Location' => url("/api/patients/{$patient->id}")
        ]);

    }

    /**
     * @OA\Get(
     *     path="/api/patienties/{patient}",
     *     summary="Get patient by ID",
     *     description="Returns a single patient",
     *     operationId="getPatientById",
     *
     *     @OA\Parameter(
     *         name="patient",
     *         in="path",
     *         description="ID of the patient",
     *         required=true,
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Patient located successfully",
     *
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/Patient"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found",
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
    public function show(Patient $patient) : JsonResponse
    {
        return response()->json($patient->address(),JsonResponse::HTTP_OK);
    }

    public function generateTicketPatient(Patient $patient) : JsonResponse
    {
        return response()->json($patient->appointments());
    }

    public function update(UpdatePatientRequest $request, Patient $patient): JsonResponse
    {
        $patient->update($request->all());
        $patient->push();

        return response()->json($patient, status: JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(Patient $patient): Response
    {
        $patient->deleteOrFail();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
