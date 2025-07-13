<?php

namespace App\Http\Controllers\API\ModuloCompra;

use App\Http\Controllers\Controller;
use App\Http\Requests\Proveedor\StoreProveedorRequest;
use App\Http\Requests\Proveedor\UpdateProveedorRequest;
use App\Http\Resources\ProveedorResource;
use App\Services\ProveedorService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProveedorController extends Controller
{
    protected $ProveedorService;

    public function __construct(ProveedorService $ProveedorService)
    {
        $this->ProveedorService = $ProveedorService;
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['razon_social','correo','telefono','direccion','codigo','estado']);
        $perPage = $request->input('per_page', 10);

        $sortField = $request->input('sortField', 'id'); // Campo por defecto
        $sortOrder = $request->input('sortOrder', 'asc'); // Orden por defecto

        $proveedores = $this->ProveedorService->getAllPaginated($filters,$perPage,$sortField,$sortOrder);
        
        return response()->json($proveedores, 200);
    }

    public function store(StoreProveedorRequest $request): JsonResponse
    {
        $proveedor = $this->ProveedorService->create($request->validated());
        return response()->json(new ProveedorResource($proveedor), 201);
    }

    public function show($id): JsonResponse
    {
        $proveedor = $this->ProveedorService->find($id);
        return response()->json(new ProveedorResource($proveedor), 200);
    }

    public function ShowCodigo($codigo): JsonResponse
    {
        $proveedor = $this->ProveedorService->findbycodigo($codigo);
        return response()->json($proveedor, 200);
    }

    public function update(UpdateProveedorRequest $request, $id): JsonResponse
    {
        $proveedor = $this->ProveedorService->update($id, $request->validated());
        return response()->json(new ProveedorResource($proveedor), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->ProveedorService->destroy($id);
        return response()->json(['message' => 'Proveedor inactivo.'], 200);
    }

    public function restore($id): JsonResponse
    {
        $proveedor = $this->ProveedorService->restore($id);
        return response()->json(new ProveedorResource($proveedor), 200);
    }

    public function EstadoCuentaGeneral($id,$id_gestion): JsonResponse
    {
        $estado = $this->ProveedorService->EstadoCuentaGeneral($id,$id_gestion);
        return response()->json($estado, 200);
    }

    public function EstadoCuentaGeneralDevolucion($id,$id_gestion): JsonResponse
    {
        $estado = $this->ProveedorService->EstadoCuentaDevolucion($id,$id_gestion);
        return response()->json($estado, 200);
    }

    public function EstadoCuentaGeneralPDF($id,$id_gestion): JsonResponse
    {
        $estado = $this->ProveedorService->EstadoCuentaPDF($id,$id_gestion);
        return response()->json($estado, 200);
    }

    public function EstadoCuentaGeneralPDFdevolucion($id,$id_gestion): JsonResponse
    {
        $estado = $this->ProveedorService->EstadoCuentaPDFdevolucion($id,$id_gestion);
        return response()->json($estado, 200);
    }

}

