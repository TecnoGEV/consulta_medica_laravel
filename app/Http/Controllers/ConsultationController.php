<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Models\Consultation;
use Illuminate\Http\JsonResponse;

class ConsultationController extends Controller
{
 
    public function index() : JsonResponse
    {
        return response()->json(Consultation::class, JsonResponse::HTTP_OK);
    }

    public function store(StoreConsultationRequest $request) : JsonResponse
    {
        $consultation = Consultation::createOrFail($request->all());
        return response()->json([
            'consultation' => $consultation, 
            'success' => 'Consulta atualizada com sucesso'
        ], JsonResponse::HTTP_CREATED)
        ->header('Location', url("/api/consultations/{$consultation->id}"));
    }

    public function show(Consultation $consultation) : JsonResponse
    {
        return response()->json(['consultation' => $consultation],JsonResponse::HTTP_OK);
    }

    public function update(UpdateConsultationRequest $request, Consultation $consultation) : JsonResponse
    {
        $consultation->updateOrFail($request->all());
        $consultation->saveOrFail();
        return response()->josn([
            'consultation' => $consultation, 
            'msg' => 'Atualizado com sucesso.'
        ], JsonResponse::HTTP_OK);   
    }

    public function destroy(Consultation $consultation) : JsonResponse
    {
        $consultation->deleteOrFail();
        return response()->statusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
