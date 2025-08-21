<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Http\Resources\ProductoResource;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        return ProductoResource::collection(Producto::paginate());
    }

    public function store(StoreProductoRequest $request)
    {
        $producto = Producto::create($request->validated());
        return (new ProductoResource($producto))->response()->setStatusCode(201);
    }

    public function show(Producto $producto)
    {
        return new ProductoResource($producto);
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $producto->update($request->validated());
        return new ProductoResource($producto);
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->noContent();
    }
}
