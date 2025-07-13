<?php

namespace App\Http\Controllers\API\ModuloCompra;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotaCompra\StoreNotaCompraRequest;
use App\Http\Requests\NotaCompra\UpdateNotaCompraRequest;
use App\Http\Requests\NotaCompra\AnularNotaCompraRequest;
use App\Http\Resources\NotaCompraResource;
use App\Services\NotaCompraService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotaCompraController extends Controller
{
    protected $NotaCompraService;
    protected $detalleVentaService;

    public function __construct(NotaCompraService $NotaCompraService)
    {
        $this->NotaCompraService = $NotaCompraService;
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['fecha','gestion','proveedor','codigo_factura','created_at']);
        $perPage = $request->input('per_page', 10);

        $sortField = $request->input('sortField', 'id'); // Campo por defecto
        $sortOrder = $request->input('sortOrder', 'asc'); // Orden por defecto

        $notasVenta = $this->NotaCompraService->getAllPaginated($filters,$perPage,$sortField,$sortOrder);
        
        return response()->json($notasVenta, 200);
    }

    public function DetalleNota($id_nota): JsonResponse
    {
        $detalles = $this->NotaCompraService->getAllDetallesNotaVenta($id_nota);
        return response()->json($detalles, 200);
    }

    public function store(StoreNotaCompraRequest $request)
    {
        $notaVenta = $this->NotaCompraService->create($request->validated());
        return  response()->json(new NotaCompraResource($this->NotaCompraService->find($notaVenta->id)), 201);
    }

    public function show($id)
    {
        $notaVenta = $this->NotaCompraService->find($id);
        return  response()->json(new NotaCompraResource($notaVenta), 200);
    }

    public function update(UpdateNotaCompraRequest $request, $id)
    {
        $notaVenta = $this->NotaCompraService->update($id, $request->validated());
        return response()->json(['status' => $notaVenta], 200);
    }

    public function anular_nota(AnularNotaCompraRequest $request)
    {
        $notaVenta = $this->NotaCompraService->anular($request->validated());
        return response()->json(['status' => $notaVenta], 200);
    }
    
    public function completar_firma($id): JsonResponse
    {
        $notaVenta = $this->NotaCompraService->firma_completar($id);
        return response()->json(['status' => $notaVenta], 200);
    }
    
}