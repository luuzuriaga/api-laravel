<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return $this->success(Category::withCount('products')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return $this->success($category, 'Categoría creada correctamente', 201);
    }

    public function show(Category $category)
    {
        return $this->success($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return $this->success($category, 'Categoría actualizada correctamente');
    }
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return $this->error('No se puede eliminar la categoría porque tiene productos asociados', null, 409);
        }
        $category->delete();
        return $this->success(null, 'Categoría eliminada correctamente');
    }


}
