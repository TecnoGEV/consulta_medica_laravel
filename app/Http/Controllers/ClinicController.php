<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClinicRequest;
use App\Http\Requests\UpdateClinicRequest;
use App\Models\Clinic;
use Illuminate\Http\JsonResponse;

class ClinicController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['clinic' => Clinic::all()->paginate(20, ['*'], 'page')], JsonResponse::HTTP_OK);
    }

    public function store(StoreClinicRequest $request): JsonResponse
    {
        $clinic = Clinic::createOrFail($request->all());

        return response()
            ->json(['clinic' => $clinic], JsonResponse::HTTP_CREATED)
            ->header('Location', url("/api/clinics/{$clinic}"));
    }

    public function show(Clinic $clinic): JsonResponse
    {
        return response()->json(['clinic' => $clinic]);
    }

    public function update(UpdateClinicRequest $request, Clinic $clinic): JsonResponse
    {

        $clinic->updateOrFail($request->all());
        $clinic->saveOrFail();

        return response()->statusCode([
            'clinic' => $clinic,
            'status' => 'Atualizado com sucesso',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinic $clinic): JsonResponse
    {
        $clinic->deleteOrFail();

        return response()->json(JsonResponse::HTTP_NO_CONTENT);  //
    }
}
