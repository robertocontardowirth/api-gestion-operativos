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
        return TutorResource::collection(Tutor::with('uploads')->paginate());
    }

    public function store(StoreTutorRequest $request)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? [];
        unset($data['upload_ids']);

        $tutor = Tutor::create($data);
        if (!empty($uploads)) {
            $tutor->uploads()->sync($uploads);
        }

        return (new TutorResource($tutor->load('uploads')))->response()->setStatusCode(201);
    }

    public function show(Tutor $tutore) // nombre por convención
    {
        return new TutorResource($tutore->load('uploads'));
    }

    public function update(UpdateTutorRequest $request, Tutor $tutore)
    {
        $data = $request->validated();
        $uploads = $data['upload_ids'] ?? null;
        unset($data['upload_ids']);

        $tutore->update($data);
        if (!is_null($uploads)) {
            $tutore->uploads()->sync($uploads);
        }

        return new TutorResource($tutore->load('uploads'));
    }

    public function destroy(Tutor $tutore)
    {
        $tutore->delete();
        return response()->noContent();
    }
}
