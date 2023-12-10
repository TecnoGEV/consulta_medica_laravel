<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\JsonResponse;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(['doctors' => Doctor::all()->paginate(20, ['*'], 'page')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request): JsonResponse
    {
        $doctor = Doctor::createOrFail($request->all());

        return response()
            ->json([
                'doctors' => $doctor,
                'status' => 'Criado com sucesso',
            ])->header('Location', url("/api/doctors/{$doctor->id}"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor): JsonResponse
    {
        return response()->json(['doctor' => $doctor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->updateOrFail($request->all());
        $doctor->saveOrFail();

        return response()->json([
            'doctor' => $doctor,
            'status' => 'Atualizado com sucesso.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor): JsonResponse
    {
        $doctor->deleteOrFail();

        return response()->statusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
