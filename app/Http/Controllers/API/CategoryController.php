<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories(): JsonResponse
    {
        return response()->json(['categories' => Category::paginate()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        try {
            $data = Category::create($request->validated());
            if ($data) return response()->json(['message' => 'Datos correctamente creados', 'data' => $data], 201);
            return response()->json($data, 400);
        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }

    public function show(Category $category): JsonResponse
    {
        try {
            $data = Category::find($category);
            if ($data) return response()->json($data, 200);
            return response()->json(['Error' => 'Sucedió un error al buscar los datos']);
        } catch (\Throwable $th) {
            return response()->json(['Error' => 'Sucedió un error inesperado en el servidor, vuelve a intentar']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Category  $category
     */

    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        try {
            $process = $category->update($request->validated());
            if ($process) return response()->json(['message' => 'Actualizado', 'data' => $category], 201);
            return response()->json(['error' => 'No se lograron actualizar los datos'], 400);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Error inesperado: $th"], 400);
        }
    }


    public function destroy(Category $id): JsonResponse
    {
        try {
            $process = $id->delete();
            if ($process) return response()->json(['message' => 'Eliminado exitosamente']);
            return response()->json(['message' => 'Sucedió un error al eliminar, intenta de nuevo']);
        } catch (\Throwable $th) {
            return response()->json(['Error' => "Error inesperado $th)"]);
        }
    }
}
