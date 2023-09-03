<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function getSales(): JsonResponse
    {
        return response()->json([Sale::paginate()]);
    }

    public function store(SaleRequest $request): JsonResponse
    {
        try {
            $data = Sale::create($request->validated());
            if ($data) return response()->json(['message' => 'Datos correctamente creados', 'data' => $data], 201);
            return response()->json(['error' => 'Los datos no lograron ser guardados'], 400);
        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }

    public function show(Sale $sale): JsonResponse
    {
       try {
        $data = Sale::find($sale);
        if ($data) return response()->json($data, 200);
        return response()->json(['Error' => 'Sucedió un error al buscar los datos']);
       } catch (\Throwable $th) {
        return response()->json(['Error' => 'Sucedió un error inesperado en el servidor, vuelve a intentar']);
       }
    }

    public function update(SaleRequest $request, Sale $sale): JsonResponse
    {
        try {
            $process = $sale->update($request->validated());
            if ($process) return response()->json(['message' => 'Actualizado', 'data' => $sale], 201);
            return response()->json(['error' => 'No se lograron actualizar los datos'], 400);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Error inesperado: $th"], 400);
        }
    }


    public function destroy(Sale $id): JsonResponse
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
