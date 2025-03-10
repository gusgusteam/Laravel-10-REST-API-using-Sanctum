<?php

namespace App\Http\Controllers\API\ModuloVenta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\StoreClienteRequest;
use App\Http\Requests\Cliente\UpdateClienteRequest;
use App\Http\Resources\ClienteResource;
use App\Services\ClienteService;
use Illuminate\Http\JsonResponse;

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index(): JsonResponse
    {
        $clientes = $this->clienteService->getAll();
        return response()->json(ClienteResource::collection($clientes), 200);
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
}

