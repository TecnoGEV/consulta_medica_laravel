<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Exam;
use Illuminate\Http\JsonResponse;

class ExamController extends Controller
{
    public function __construct(private Exam $exam)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->exam->all()->paginate(20, ['*'], 'page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamRequest $request)
    {
        $exam = $this->exam->createOrFail($request->all());

        return response()->json([
            'exam' => $exam,
            'status' => 'Criado com sucesso',
        ])->header('Location', url("/api/exams/{$exam->id}"));
    }

    public function show(Exam $exam): JsonResponse
    {
        return response()->json(['exam' => $exam]);
    }

    public function update(UpdateExamRequest $request, Exam $exam): JsonResponse
    {
        $exam->updateOrFail($request->all());
        $exam->saveOrFail();

        return response()->json(['exam' => $exam, 'status' => 'Atualizado com sucesso.']);
    }

    public function destroy(Exam $exam): JsonResponse
    {
        $exam->deleteOrFail();

        return response()->statusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
