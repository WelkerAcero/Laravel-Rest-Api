<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $dbAttri = array(
        'id',
        'sale_code',
        'quantity',
        'product_id',
        'sub_total'
    );
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts(): JsonResponse
    {
        return response()->json(['products' => Product::select($this->dbAttri)->paginate()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request): JsonResponse
    {
        try {
            $data = Product::create($request->validated());
            if ($data) return response()->json(['message' => 'Datos correctamente creados', 'data' => $data], 201);
            return response()->json($data, 400);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Error inesperado: $th"]);
        }
    }

    public function show(Product $product): JsonResponse
    {
        try {
            $data = Product::find($product);
            if ($data) return response()->json($data, 200);
            return response()->json(['Error' => 'Sucedió un error al buscar los datos']);
        } catch (\Throwable $th) {
            return response()->json(['Error' => 'Sucedió un error inesperado en el servidor, vuelve a intentar']);
        }
    }

    public function update(ProductRequest $request, Product $data): JsonResponse
    {
        try {
            $process = $data->update($request->validated());
            if ($process) return response()->json($data, 201);
            return response()->json(['error' => 'No se lograron actualizar los datos'], 400);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error inesperado'], 400);
        }
    }


    public function destroy(Product $id): JsonResponse
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
