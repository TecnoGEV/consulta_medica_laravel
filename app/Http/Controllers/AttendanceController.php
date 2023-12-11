<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AttendanceController extends Controller
{
    public function  __construct(private Attendance $attendance)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->attendance->paginate(20, ['*'], 'page'));
    }

    public function store(StoreAttendanceRequest $request): Response
    {
        $attendance = $this->attendance->create($request->all());
        return response(status:Response::HTTP_CREATED, headers:[
            'Location' => url("/api/attendance/{$attendance->id}")
        ]);
    }

    public function show(Attendance $attendance): JsonResponse
    {
        return response()->json($attendance);
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance): JsonResponse
    {
        $attendance->updateOrFail($request->all());
        $attendance->push();
        return response()->json($attendance, JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(Attendance $attendance): Response
    {
        $attendance->deleteOrFail();
        return response(status:Response::HTTP_NO_CONTENT);
    }
}
