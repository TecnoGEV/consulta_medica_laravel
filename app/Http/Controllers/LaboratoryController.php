<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaboratoryRequest;
use App\Http\Requests\UpdateLaboratoryRequest;
use App\Models\Laboratory;
use Illuminate\Http\JsonResponse;

class LaboratoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Laboratory::all(), JsonResponse::HTTP_OK);
    }

    public function store(StoreLaboratoryRequest $request): JsonResponse
    {
        $laboratory = Laboratory::createOrFail($request->all());

        return response()->json(
            $laboratory,
            JsonResponse::HTTP_CREATED,
        )->header('Location', url("/api/laboratorio/{$laboratory->id}"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Laboratory $laboratory)
    {
        return response()->json($laboratory, JsonResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaboratoryRequest $request, Laboratory $laboratory): JsonResponse
    {
        $laboratory->updateOrFail($request->all());
        $laboratory->saveOrFail();

        return response()->json($laboratory, JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laboratory $laboratory)
    {
        $laboratory->deleteOrFail();

        return response()->statusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
