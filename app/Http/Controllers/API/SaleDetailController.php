<?php

namespace App\Http\Controllers\API;

use App\Events\NewSaleEvent;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleDetailRequest;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetail;

class SaleDetailController extends Controller
{
    public function getSales(): JsonResponse
    {
        return response()->json([SaleDetail::paginate()]);
    }

    public function store(SaleDetailRequest $request): JsonResponse
    {
        try {
            $data = SaleDetail::create($request->validated());

            if ($data) {
                $notification = Customer::with('sales.customers')
                ->whereRelation('sales', 'sale_code', '=', $data->sale_code_id)
                ->get();

                event(new NewSaleEvent(['sale_detail_creation' => $notification])); // Dispara el evento con los datos  

                return response()->json(['message' => 'Datos correctamente creados', 'notification' => $notification], 201);
            }
            return response()->json(['error' => 'Los datos no lograron ser guardados'], 400);
        } catch (\Throwable $th) {
            return response()->json(["error inesperado: $th"], 400);
        }
    }

    public function show(SaleDetail $sale_details): JsonResponse
    {
        try {
            $data = SaleDetail::find($sale_details);
            if ($data) return response()->json($data, 200);
            return response()->json(['Error' => 'Sucedió un error al buscar los datos']);
        } catch (\Throwable $th) {
            return response()->json(['Error' => 'Sucedió un error inesperado en el servidor, vuelve a intentar']);
        }
    }

    public function update(SaleDetailRequest $request, SaleDetail $sale_details): JsonResponse
    {
        try {
            $process = $sale_details->update($request->validated());
            if ($process) return response()->json(['message' => 'Actualizado', 'data' => $sale_details], 201);
            return response()->json(['error' => 'No se lograron actualizar los datos'], 400);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Error inesperado: $th"], 400);
        }
    }


    public function destroy(SaleDetail $id): JsonResponse
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
