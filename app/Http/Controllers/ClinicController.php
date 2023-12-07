<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClinicRequest;
use App\Http\Requests\UpdateClinicRequest;
use App\Models\Clinic;
use Illuminate\Http\JsonResponse;

class ClinicController extends Controller
{

    public function __construct(private Clinic $clinic){}
    
    public function index() : JsonResponse
    {
        return response()->json($this->clinic->all(), JsonResponse::HTTP_OK);  
    }

    public function store(StoreClinicRequest $request) : JsonResponse
    {
        $clinic = Clinic::createOrFail($request->all());
        return response()->json($clinic, JsonResponse::HTTP_OK);
    }

    public function show(string $clinic) : JsonResponse
    {   $clinic_find = Clinic::find(intval($clinic));
        if (empty($clinic_find)) {
            return response()->json(['error' => 'Clinica não existe'], JsonResponse::HTTP_NOT_FOUND);
        }
        return response()->json($clinic_find);
    }

    public function update(UpdateClinicRequest $request, Clinic $clinic) : JsonResponse
    {   

        $clinic->updateOrFail($request->all());
        $clinic->saveOrFail();

        return response()->statusCode(['success' => "Atualizado com sucesso"],JsonResponse::HTTP_OK);  //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinic $clinic) : JsonResponse
    {
        $clinic->deleteOrFail();
        return response()->json(JsonResponse::HTTP_OK);  //
    }
}
