<?php

namespace App\Http\Controllers\API\ModuloDevolucion;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotaDevolucion\StoreNotaDevolucionRequest;
use App\Http\Requests\NotaDevolucion\UpdateNotaDevolucionRequest;
use App\Http\Requests\NotaDevolucion\AnularNotaDevolucionRequest;
use App\Http\Resources\NotaDevolucionResource;
use App\Services\NotaDevolucionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotaDevolucionController extends Controller
{
    protected $NotaDevolucionService;

    public function __construct(NotaDevolucionService $NotaDevolucionService)
    {
        $this->NotaDevolucionService = $NotaDevolucionService;
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['fecha','gestion','cliente','proveedor','optionNota','codigo_factura','created_at']);
        $perPage = $request->input('per_page', 10);

        $sortField = $request->input('sortField', 'id'); // Campo por defecto
        $sortOrder = $request->input('sortOrder', 'asc'); // Orden por defecto

        $notasVenta = $this->NotaDevolucionService->getAllPaginated($filters,$perPage,$sortField,$sortOrder);
        
        return response()->json($notasVenta, 200);
    }

    public function DetalleNota($id_nota): JsonResponse
    {
        $detalles = $this->NotaDevolucionService->getAllDetallesNotaDevolucion($id_nota);
        return response()->json($detalles, 200);
    }

    public function store(StoreNotaDevolucionRequest $request)
    {
        $notaVenta = $this->NotaDevolucionService->create($request->validated());
        return  response()->json(new NotaDevolucionResource($this->NotaDevolucionService->find($notaVenta->id)), 201);
    }

    public function show($id)
    {
        $notaVenta = $this->NotaDevolucionService->find($id);
        return  response()->json(new NotaDevolucionResource($notaVenta), 200);
    }

    public function update(UpdateNotaDevolucionRequest $request, $id)
    {
        $notaVenta = $this->NotaDevolucionService->update($id, $request->validated());
        return response()->json(['status' => $notaVenta], 200);
    }

    public function anular_nota(AnularNotaDevolucionRequest $request)
    {
        $notaVenta = $this->NotaDevolucionService->anular($request->validated());
        return response()->json(['status' => $notaVenta], 200);
    }
    
    public function completar_firma($id): JsonResponse
    {
        $notaVenta = $this->NotaDevolucionService->firma_completar($id);
        return response()->json(['status' => $notaVenta], 200);
    }
    
}