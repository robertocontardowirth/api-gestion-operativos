<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUploadRequest;
use App\Http\Requests\UpdateUploadRequest;
use App\Http\Resources\UploadResource;
use App\Models\Upload;

class UploadController extends Controller
{
    public function index()
    {
        return UploadResource::collection(Upload::paginate());
    }

    public function store(StoreUploadRequest $request)
    {
        $upload = Upload::create($request->validated());
        return (new UploadResource($upload))->response()->setStatusCode(201);
    }

    public function show(Upload $upload)
    {
        return new UploadResource($upload);
    }

    public function update(UpdateUploadRequest $request, Upload $upload)
    {
        $upload->update($request->validated());
        return new UploadResource($upload);
    }

    public function destroy(Upload $upload)
    {
        $upload->delete();
        return response()->noContent();
    }
}
