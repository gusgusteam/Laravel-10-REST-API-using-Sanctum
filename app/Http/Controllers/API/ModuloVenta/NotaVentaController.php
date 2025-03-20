<?php

namespace App\Http\Controllers\API\ModuloVenta;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotaVenta\StoreNotaVentaRequest;
use App\Http\Requests\NotaVenta\UpdateNotaVentaRequest;
use App\Http\Requests\NotaVenta\AnularNotaVentaRequest;
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
        return response()->json(['status' => $notaVenta], 200);
        //return  response()->json(new NotaVentaResource($notaVenta), 200);
    }

    public function anular_nota(AnularNotaVentaRequest $request)
    {
        $notaVenta = $this->notaVentaService->anular($request->validated());
        return response()->json(['status' => $notaVenta], 200);
    }
    
    public function completar_firma($id): JsonResponse
    {
        $notaVenta = $this->notaVentaService->firma_completar($id);
        return response()->json(['status' => $notaVenta], 200);
    }
    
}