<?php

namespace App\Repositories;

use App\Models\NotaCompra;

class NotaCompraRepository
{
    public function AllPaginated(array $filters, int $perPage, string $sortField, string $sortOrder)
    {
        $query = NotaCompra::with(['proveedor', 'user', 'gestion']); // Carga relaciones

        // Filtrar por nombre si se proporciona
        if (!empty($filters['fecha'])) {
            $query->where('fecha', 'LIKE', '%' . $filters['fecha'] . '%');
        }
        if (!empty($filters['codigo_factura'])) {
            $query->orWhere('codigo_factura', 'LIKE', '%' .$filters['codigo_factura']. '%');
        }

        if (!empty($filters['proveedor']) && $filters['proveedor'] !== 'null') { // id cliente
            $query->whereHas('proveedor', function ($q) use ($filters) {
                $q->where('codigo', '=',$filters['proveedor']);
            });
        }

        if (!empty($filters['gestion']) && $filters['gestion'] !== 'null') { //id gestion
            $query->whereHas('gestion', function ($q) use ($filters) {
                $q->where('id', '=',$filters['gestion']);
            });
        }

        // Aplicar ordenación
        $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        // Retornar con paginación
        return $query->paginate($perPage);
    }

    public function detallesNotaCompra($id_NotaCompra)
    {
        $notaCompra = NotaCompra::with('detallesCompra.productoEnvase.producto', 'detallesCompra.productoEnvase.unidad')->findOrFail($id_NotaCompra);
        return $notaCompra->detallesCompra;
    }
    
    public function all()
    {
        return NotaCompra::with(['user', 'gestion', 'proveedor'])->get();
    }

    public function find($id)
    {
        return NotaCompra::with(['user', 'gestion', 'proveedor'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return NotaCompra::create($data);
    }

    public function update($id, array $data)
    {
        $notaCompra = $this->find($id);
        if(!$notaCompra->firma){
            if($notaCompra->update($data)){
                return true;
            } 
        }
        return false;
    }

    public function completar_firma($id)
    {
        $notaCompra = $this->find($id);
        if(!$notaCompra->firma){
            $notaCompra->firma = 1;
            if($notaCompra->update()){
                return true;
            } 
        }
        return false;
    }

    public function anular_nota(array $data) // anula nota y no lo elimina de la base de datos
    {
        $codigo_factura = $data['codigo_factura'];
        $motivo = $data['motivo'];
        $notaCompra = NotaCompra::where('codigo_factura', $codigo_factura)->first();
        if($notaCompra){
            $notaCompra->codigo_alterno = $notaCompra->codigo_factura;
            $notaCompra->codigo_factura = $notaCompra->codigo_factura .'-'.$notaCompra->id.'-ANULADO';
            $notaCompra->nota_alterna = 1; 
            $notaCompra->motivo = $motivo;
            if($notaCompra->update()){
                return true;
            } 
        }
        
        return false;
    }
}