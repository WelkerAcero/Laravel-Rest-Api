<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCustomers(): JsonResponse
    {
        return response()->json(['customers' => Customer::paginate()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request): JsonResponse
    {
        try {
            $data = Customer::create($request->validated());
            if ($data) return response()->json(['message' => 'Datos creados correctamente', 'data' => $data], 201);
            return response()->json(['error' => 'Los datos no lograron ser guardados'], 400);
        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }

    public function show(Customer $customer): JsonResponse
    {
        try {
            $data = Customer::find($customer);
            if ($data) return response()->json($data, 200);
            return response()->json(['Error' => 'Sucedió un error al buscar los datos'], 404);
        } catch (\Throwable $th) {
            return response()->json(['Error' => "Sucedió un error inesperado en el servidor $th, vuelve a intentar"]);
        }
    }

    public function update(CustomerRequest $request, Customer $customer): JsonResponse
    {
        try {
            $process = $customer->update($request->validated());
            if ($process) return response()->json(['message' => 'Actualizado', 'data' => $customer], 201);
            return response()->json(['error' => 'No se lograron actualizar los datos'], 400);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Error inesperado: $th"], 400);
        }
    }


    public function destroy(Customer $id): JsonResponse
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
