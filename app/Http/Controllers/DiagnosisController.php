<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiagnosisRequest;
use App\Http\Requests\UpdateDiagnosisRequest;
use App\Models\Diagnosis;
use Illuminate\Http\JsonResponse;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => Diagnosis::all()->paginate(20, ['*'], 'page')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiagnosisRequest $request)
    {
        $created = Diagnosis::createOrFail($request->all());

        return response()->json([
            'diagnosis' => $created,
            'status' => 'Criado com sucesso.',
        ], JsonResponse::HTTP_CREATED)
            ->header('Location', url("/api/diagnosis/{$created}"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnosis $diagnosis)
    {
        return response()->json(['diagnosis' => $diagnosis]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiagnosisRequest $request, Diagnosis $diagnosis): JsonResponse
    {
        $diagnosis->updateOrFail($request->all());
        $diagnosis->saveOrFail();

        return response()->json([
            'diagnosis' => $diagnosis,
            'status' => 'Atualizado com sucesso.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnosis $diagnosis): JsonResponse
    {
        $diagnosis->deleteOrFail();

        return response()->statusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
