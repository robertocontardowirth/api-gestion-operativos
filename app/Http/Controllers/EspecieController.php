<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEspecieRequest;
use App\Http\Requests\UpdateEspecieRequest;
use App\Http\Resources\EspecieResource;
use App\Models\Especie;

class EspecieController extends Controller
{
    public function index()
    {
        return EspecieResource::collection(Especie::paginate());
    }

    public function store(StoreEspecieRequest $request)
    {
        $especie = Especie::create($request->validated());
        return (new EspecieResource($especie))->response()->setStatusCode(201);
    }

    public function show(Especie $especy) // parámetro por convención REST de Laravel
    {
        return new EspecieResource($especy);
    }

    public function update(UpdateEspecieRequest $request, Especie $especy)
    {
        $especy->update($request->validated());
        return new EspecieResource($especy);
    }

    public function destroy(Especie $especy)
    {
        $especy->delete();
        return response()->noContent();
    }
}
