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
    public function __construct(private Patient $patient)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->patient->paginate('20', ['*'], 'page'));
    }

    public function store(StorePatientRequest $request): Response
    {
        $this->patient->create($request->all());

        return response(status: Response::HTTP_CREATED, headers: [
            'Location' => url("/api/patients/{$this->patient->id}"),
        ]);
    }

    public function show(Patient $patient): JsonResponse
    {
        return response()->json($patient);
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
