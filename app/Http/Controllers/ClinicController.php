<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreClinicRequest;
use App\Http\Requests\UpdateClinicRequest;
use App\Models\Clinic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ClinicController extends Controller
{
    public function __construct(private Clinic $clinic)
    {

    }

    public function index(): JsonResponse
    {
        return response()->json($this->clinic->paginate(20, ['*'], 'page'));
    }

    public function store(StoreClinicRequest $request): Response
    {
        $clinic = $this->clinic->create($request->all());

        return response(status: Response::HTTP_CREATED, headers: [
            'Location' => url("/api/clinics/{$clinic->id}"),
        ]);
    }

    public function show(Clinic $clinic): JsonResponse
    {
        return response()->json($clinic);
    }

    public function update(UpdateClinicRequest $request, Clinic $clinic): JsonResponse
    {
        $clinic->updateOrFail($request->all());
        $clinic->push();

        return response()->json($clinic, JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(Clinic $clinic): Response
    {
        $clinic->deleteOrFail();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
