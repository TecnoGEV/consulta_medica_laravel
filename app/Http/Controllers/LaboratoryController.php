<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaboratoryRequest;
use App\Http\Requests\UpdateLaboratoryRequest;
use App\Models\Laboratory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LaboratoryController extends Controller
{
    public function __construct(private Laboratory $laboratory)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->laboratory->paginnate('20', ['*'], 'page'));
    }

    public function store(StoreLaboratoryRequest $request): Response
    {
        $this->laboratory->create($request->all());

        return response(status: JsonResponse::HTTP_CREATED, headers: [
            'Location' => url("/api/laboratorio/{$this->laboratory->id}"),
        ]);
    }

    public function show(Laboratory $laboratory)
    {
        return response()->json($laboratory, JsonResponse::HTTP_OK);
    }

    public function update(UpdateLaboratoryRequest $request, Laboratory $laboratory): JsonResponse
    {
        $laboratory->updateOrFail($request->all());
        $laboratory->push();

        return response()->json($laboratory, JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(Laboratory $laboratory): Response
    {
        $laboratory->deleteOrFail();

        return response(status: JsonResponse::HTTP_NO_CONTENT);
    }
}
