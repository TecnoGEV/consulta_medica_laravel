<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowUpRequest;
use App\Http\Requests\UpdateFollowUpRequest;
use App\Models\FollowUp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FollowUpController extends Controller
{
   
    public function __construct(private FollowUp $followUp)
    {        
    }

    public function index() : JsonResponse
    {    
        return response()->json($this->followUp->paginate('20', ['*'], 'page'));
    }

    public function store(StoreFollowUpRequest $request) : Response
    {
        $this->followUp->create($request->all());
        return response(status:Response::HTTP_CREATED, headers:[
            'Location' => url("api/follow-ups/{$this->followUp->id}")
        ]); 
    }

    public function show(FollowUp $followUp) : JsonResponse
    {
        return response()->json($followUp);
    }

    public function update(UpdateFollowUpRequest $request, FollowUp $followUp) : JsonResponse
    {
        $followUp->updateOrFail($request->all());
        $followUp->push();
        return response()->json($followUp, JsonResponse::HTTP_ACCEPTED);
    }

    public function destroy(FollowUp $followUp) : Response
    {
        $followUp->deleteOrFail();
        return response(status:Response::HTTP_NO_CONTENT);
    }
}
