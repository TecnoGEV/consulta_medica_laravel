<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function __construct(private Report $report)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->report->paginate('20', ['*'], 'page'));
    }

    public function store(StoreReportRequest $request): Response
    {
        $this->report->create($request->all());

        return response(status: Response::HTTP_CREATED, headers: [
            'Location' => url("/api/reports/{$this->report->id}"),
        ]);
    }

    public function show(Report $report): JsonResponse
    {
        return response()->json($report);
    }

    public function update(UpdateReportRequest $request, Report $report): JsonResponse
    {
        $report->updateOrFail($request->all());
        $report->push();

        return response()->json(data: $report, status: JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(Report $report): Response
    {
        $report->deleteOrFail();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
