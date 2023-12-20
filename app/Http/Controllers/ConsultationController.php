<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Models\Consultation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ConsultationController extends Controller
{
    public function __construct(private Consultation $consultation)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->consultation->paginate('20', ['*'], 'page'));
    }

    public function store(StoreConsultationRequest $request): Response
    {
        $this->consultation->create($request->all());

        return response(status: Response::HTTP_CREATED, headers: [
            'Location' => url("/api/consultations/{$this->consultation->id}"),
        ]);
    }

    public function show(Consultation $consultation): JsonResponse
    {
        return response()->json($consultation);
    }

    public function update(UpdateConsultationRequest $request, Consultation $consultation): JsonResponse
    {
        $consultation->updateOrFail($request->all());
        $consultation->push();

        return response()->json($consultation, JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(Consultation $consultation): Response
    {
        $consultation->deleteOrFail();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
