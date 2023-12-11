<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpecializationRequest;
use App\Http\Requests\UpdateSpecializationRequest;
use App\Models\Specialization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SpecializationController extends Controller
{
    
    public function __construct(private Specialization $specialization)
    {
        
    }

    public function index() : JsonResponse
    {
        return response()->json($this->specialization->paginate('20',['*'], 'page')); 
    }

    public function store(StoreSpecializationRequest $request) : Response
    {
        $this->specialization->create($request->all());
        return response(status: Response::HTTP_CREATED, headers: [
            'Location' => url("/api/specializations/{$this->specialization->id}")
        ]);
    }

    public function show(Specialization $specialization) : JsonResponse
    {
        return response()->json($specialization);
    }

    public function update(UpdateSpecializationRequest $request, Specialization $specialization)
    {
        $specialization->updateOrFail($request->all());
        $specialization->push();
        return response()->json($specialization, status:JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(Specialization $specialization) : Response
    {
        $specialization->deleteOrFail();
        return response(status:Response::HTTP_NO_CONTENT);
    }
}
