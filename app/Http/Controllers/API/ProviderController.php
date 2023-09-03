<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderRequest;
use App\Models\Provider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProviderController extends Controller
{

    public function getProviders(): JsonResponse
    {
        return response()->json(['providers' => Provider::paginate()]);
    }

    public function store(ProviderRequest $request): JsonResponse
    {
        try {
            $data = Provider::create($request->validated());
            if ($data) return response()->json(['message' => 'Datos correctamente creados', 'data' => $data], 201);
            return response()->json(['error' => 'Los datos no lograron ser guardados'], 400);
        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }

    public function show(Provider $provider): JsonResponse
    {
       try {
        $data = Provider::find($provider);
        if ($data) return response()->json($data, 200);
        return response()->json(['Error' => 'Sucedió un error al buscar los datos']);
       } catch (\Throwable $th) {
        return response()->json(['Error' => 'Sucedió un error inesperado en el servidor, vuelve a intentar']);
       }
    }

    public function update(ProviderRequest $request, Provider $data): JsonResponse
    {
        try {
            $process = $data->update($request->validated());
            if ($process) return response()->json($data, 201);
            return response()->json(['error' => 'No se lograron actualizar los datos'], 400);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error inesperado'], 400);
        }
    }


    public function destroy(Provider $id): JsonResponse
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
