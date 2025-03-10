<?php

namespace App\Http\Controllers\API\ModuloVenta;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotaVenta\StoreNotaVentaRequest;
use App\Http\Requests\NotaVenta\UpdateNotaVentaRequest;
use App\Http\Resources\NotaVentaResource;
use App\Services\NotaVentaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class NotaVentaController extends Controller
{
    protected $notaVentaService;

    public function __construct(NotaVentaService $notaVentaService)
    {
        $this->notaVentaService = $notaVentaService;
    }

    public function index()
    {
        $notasVenta = $this->notaVentaService->getAll();
        return  response()->json(NotaVentaResource::collection($notasVenta), 200);
    }

    public function store(StoreNotaVentaRequest $request)
    {
        $notaVenta = $this->notaVentaService->create($request->validated());
        return  response()->json(new NotaVentaResource($notaVenta), 201);
    }

    public function show($id)
    {
        $notaVenta = $this->notaVentaService->find($id);
        return  response()->json(new NotaVentaResource($notaVenta), 200);
    }

    public function update(UpdateNotaVentaRequest $request, $id)
    {
        $notaVenta = $this->notaVentaService->update($id, $request->validated());
        return  response()->json(new NotaVentaResource($notaVenta), 200);
    }

    public function destroy($id)
    {
        $this->notaVentaService->destroy($id);
        return response()->json(['message' => 'Nota de venta eliminada correctamente'], 200);
    }

    public function restore($id): JsonResponse
    {
        $notaVenta = $this->notaVentaService->restore($id);
        return  response()->json(new NotaVentaResource($notaVenta), 200);
    }
}