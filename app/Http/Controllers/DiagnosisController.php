<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiagnosisRequest;
use App\Http\Requests\UpdateDiagnosisRequest;
use App\Models\Diagnosis;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DiagnosisController extends Controller
{
    public function __construct(private Diagnosis $diagnosis)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->diagnosis->paginate('20', ['*'], 'page'));
    }

    public function store(StoreDiagnosisRequest $request): Response
    {
        $diagnosis = $this->diagnosis->create($request->all());

        return response(status: Response::HTTP_CREATED, headers: [
            'Location' => url("/api/diagnosis/{$diagnosis->id}"),
        ]);
    }

    public function show(Diagnosis $diagnosis): JsonResponse
    {
        return response()->json($diagnosis);
    }

    public function update(UpdateDiagnosisRequest $request, Diagnosis $diagnosis): JsonResponse
    {
        $diagnosis->updateOrFail($request->all());
        $diagnosis->push();

        return response()->json($diagnosis, JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(Diagnosis $diagnosis): Response
    {
        $diagnosis->deleteOrFail();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
