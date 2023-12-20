<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Exam;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ExamController extends Controller
{
    public function __construct(private Exam $exam)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->exam->paginate(20, ['*'], 'page'));
    }

    public function store(StoreExamRequest $request): Response
    {
        $exam = $this->exam->createOrFail($request->all());

        return response(status: Response::HTTP_CREATED, headers: [
            'Location' => url("/api/exams/{$exam->id}"),
        ]);
    }

    public function show(Exam $exam): JsonResponse
    {
        return response()->json($exam);
    }

    public function update(UpdateExamRequest $request, Exam $exam): JsonResponse
    {
        $exam->updateOrFail($request->all());
        $exam->push();

        return response()->json($exam, JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(Exam $exam): Response
    {
        $exam->deleteOrFail();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
