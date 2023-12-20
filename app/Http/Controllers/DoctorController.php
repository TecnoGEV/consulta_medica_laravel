<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DoctorController extends Controller
{
    public function __construct(private Doctor $doctor)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->doctor->paginate(20, ['*'], 'page'));
    }

    public function store(StoreDoctorRequest $request): Response
    {
        $doctor = $this->doctor->create($request->all());

        return response(status: Response::HTTP_CREATED, headers: [
            'Location' => url("/api/doctors/{$doctor->id}"),
        ]);
    }

    public function show(Doctor $doctor): JsonResponse
    {
        return response()->json($doctor);
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->updateOrFail($request->all());
        $doctor->push();

        return response()->json($doctor, JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(Doctor $doctor): Response
    {
        $doctor->deleteOrFail();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
