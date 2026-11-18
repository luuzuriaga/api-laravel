<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Traits\ApiResponse;

class ProductController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return $this->success(Product::with('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        return $this->success($product, 'Producto creado correctamente', 201);
    }

    public function show(Product $product)
    {
        return $this->success($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return $this->success($product, 'Producto actualizado correctamente');
    }
    public function destroy(Product $product)
    {

        $product->delete();
        return $this->success(null, 'Producto eliminado correctamente');
    }


}
