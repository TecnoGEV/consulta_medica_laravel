<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Models\Consultation;
use Illuminate\Http\JsonResponse;

class ConsultationController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['consultation' => Consultation::all()->paginate(20, ['*'], 'page')]);
    }

    public function store(StoreConsultationRequest $request): JsonResponse
    {
        $consultation = Consultation::createOrFail($request->all());

        return response()->json([
            'consultation' => $consultation,
            'success' => 'Consulta criada com sucesso',
        ], JsonResponse::HTTP_CREATED)
            ->header('Location', url("/api/consultations/{$consultation->id}"));
    }

    public function show(Consultation $consultation): JsonResponse
    {
        return response()->json(['consultation' => $consultation]);
    }

    public function update(UpdateConsultationRequest $request, Consultation $consultation): JsonResponse
    {
        $consultation->updateOrFail($request->all());
        $consultation->saveOrFail();

        return response()->json([
            'consultation' => $consultation,
            'status' => 'Atualizado com sucesso.',
        ]);
    }

    public function destroy(Consultation $consultation): JsonResponse
    {
        $consultation->deleteOrFail();

        return response()->statusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
