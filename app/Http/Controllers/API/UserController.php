<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getUsers(): JsonResponse
    {
        return response()->json(['workers' => User::paginate()]);
    }


    public function store(UserRequest $request): JsonResponse
    {
        try {
            $data = User::create($request->validated());
            if ($data) return response()->json(['message' => 'Datos correctamente creados', 'data' => $data], 201);
            return response()->json(['error' => 'Los datos no lograron ser guardados'], 400);
        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }

    public function show(User $user): JsonResponse
    {
       try {
        $data = User::find($user);
        if ($data) return response()->json($data, 200);
        return response()->json(['Error' => 'Sucedió un error al buscar los datos']);
       } catch (\Throwable $th) {
        return response()->json(['Error' => 'Sucedió un error inesperado en el servidor, vuelve a intentar']);
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\User  $user
     */

    public function update(UserRequest $request, User $user): JsonResponse
    {
        try {
            $process = $user->update($request->validated());
            if ($process) return response()->json(['message' => 'Actualizado', 'data' => $user], 201);
            return response()->json(['error' => 'No se lograron actualizar los datos'], 400);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Error inesperado: $th"], 400);
        }
    }


    public function destroy(User $id): JsonResponse
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
