<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTutorRequest;
use App\Http\Requests\UpdateTutorRequest;
use App\Http\Resources\TutorResource;
use App\Models\Tutor;

class TutorController extends Controller
{
    public function index()
    {
        return TutorResource::collection(Tutor::paginate());
    }

    public function store(StoreTutorRequest $request)
    {
        $tutor = Tutor::create($request->validated());
        return (new TutorResource($tutor))->response()->setStatusCode(201);
    }

    public function show(Tutor $tutore) // nombre por convención
    {
        return new TutorResource($tutore);
    }

    public function update(UpdateTutorRequest $request, Tutor $tutore)
    {
        $tutore->update($request->validated());
        return new TutorResource($tutore);
    }

    public function destroy(Tutor $tutore)
    {
        $tutore->delete();
        return response()->noContent();
    }
}
