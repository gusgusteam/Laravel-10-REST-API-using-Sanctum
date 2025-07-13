<?php

namespace App\Http\Controllers\API\ModuloVenta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\StoreClienteRequest;
use App\Http\Requests\Cliente\UpdateClienteRequest;
use App\Http\Resources\ClienteResource;
use App\Services\ClienteService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['nombre','paterno','materno','ci','telefono','direccion','codigo','estado']);
        $perPage = $request->input('per_page', 10);

        $sortField = $request->input('sortField', 'id'); // Campo por defecto
        $sortOrder = $request->input('sortOrder', 'asc'); // Orden por defecto

        $categorias = $this->clienteService->getAllPaginated($filters,$perPage,$sortField,$sortOrder);
        
        return response()->json($categorias, 200);
    }

    public function store(StoreClienteRequest $request): JsonResponse
    {
        $cliente = $this->clienteService->create($request->validated());
        return response()->json(new ClienteResource($cliente), 201);
    }

    public function show($id): JsonResponse
    {
        $cliente = $this->clienteService->find($id);
        return response()->json(new ClienteResource($cliente), 200);
    }

    public function ShowCodigo($codigo): JsonResponse
    {
        $cliente = $this->clienteService->findbycodigo($codigo);
        return response()->json($cliente, 200);
    }

    public function update(UpdateClienteRequest $request, $id): JsonResponse
    {
        $cliente = $this->clienteService->update($id, $request->validated());
        return response()->json(new ClienteResource($cliente), 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->clienteService->destroy($id);
        return response()->json(['message' => 'Cliente inactivo.'], 200);
    }

    public function restore($id): JsonResponse
    {
        $cliente = $this->clienteService->restore($id);
        return response()->json(new ClienteResource($cliente), 200);
    }

    public function EstadoCuentaGeneral($id,$id_gestion): JsonResponse
    {
        $estado = $this->clienteService->EstadoCuentaGeneral($id,$id_gestion);
        return response()->json($estado, 200);
    }

    public function EstadoCuentaGeneralDevolucion($id,$id_gestion): JsonResponse
    {
        $estado = $this->clienteService->EstadoCuentaDevolucion($id,$id_gestion);
        return response()->json($estado, 200);
    }

    public function EstadoCuentaGeneralPDF($id,$id_gestion): JsonResponse
    {
        $estado = $this->clienteService->EstadoCuentaPDF($id,$id_gestion);
        return response()->json($estado, 200);
    }

    public function EstadoCuentaGeneralPDFdevolucion($id,$id_gestion): JsonResponse
    {
        $estado = $this->clienteService->EstadoCuentaPDFdevolucion($id,$id_gestion);
        return response()->json($estado, 200);
    }
}

