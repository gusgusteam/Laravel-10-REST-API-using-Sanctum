<?php

namespace App\Repositories;

use App\Models\NotaDevolucion;

class NotaDevolucionRepository
{
    public function AllPaginated(array $filters, int $perPage, string $sortField, string $sortOrder)
    {
        $query = NotaDevolucion::with(['cliente', 'user', 'gestion','proveedor']); // Carga relaciones

        if (!empty($filters['fecha'])) {
            $query->where('fecha', 'LIKE', '%' . $filters['fecha'] . '%');
        }
        if (!empty($filters['codigo_factura'])) {
            $query->orWhere('codigo_factura', 'LIKE', '%' .$filters['codigo_factura']. '%');
        }

        if (!empty($filters['cliente']) && $filters['cliente'] !== 'null') { // id cliente
            $query->whereHas('cliente', function ($q) use ($filters) {
                $q->where('codigo', '=',$filters['cliente']);
            });
        }
        if (!empty($filters['proveedor']) && $filters['proveedor'] !== 'null') { // id proveedor
            $query->whereHas('proveedor', function ($q) use ($filters) {
                $q->where('codigo', '=',$filters['proveedor']);
            });
        }
        if (!empty($filters['gestion']) && $filters['gestion'] !== 'null') { //id gestion
            $query->whereHas('gestion', function ($q) use ($filters) {
                $q->where('id', '=',$filters['gestion']);
            });
        }
        if (!empty($filters['optionNota']) && $filters['optionNota'] !== 'null') { //id optionNota
            if($filters['optionNota'] == '1'){
                $query->where('cliente_id', '!=', null);
            } 
            if($filters['optionNota'] == '2'){
                $query->where('proveedor_id', '!=', null);
            }
        }
        

        $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        return $query->paginate($perPage);
    }

    public function detallesNotaDevolucion($id_NotaDevolucion)
    {
        $notaDevolucion = NotaDevolucion::with(
            'detallesDevolucion.productoEnvase.producto', 
            'detallesDevolucion.productoEnvase.unidad')
        ->findOrFail($id_NotaDevolucion);

        return $notaDevolucion->detallesDevolucion;
    }
    
    public function all()
    {
        return NotaDevolucion::with(['cliente','proveedor', 'user', 'gestion'])->get();
    }

    public function find($id)
    {
        return NotaDevolucion::with(['cliente','proveedor', 'user', 'gestion'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return NotaDevolucion::create($data);
    }

    public function update($id, array $data)
    {
        $notaDevolucion = $this->find($id);
        if(!$notaDevolucion->firma){
            if($notaDevolucion->update($data)){
                return true;
            } 
        }
        return false;
    }

    public function completar_firma($id)
    {
        $notaDevolucion = $this->find($id);
        if(!$notaDevolucion->firma){
            $notaDevolucion->firma = 1;
            if($notaDevolucion->update()){
                return true;
            } 
        }
        return false;
    }

    public function anular_nota(array $data) // anula nota y no lo elimina de la base de datos
    {
        $codigo_factura = $data['codigo_factura'];
        $motivo = $data['motivo'];
        $notaDevolucion = NotaDevolucion::where('codigo_factura', $codigo_factura)->first();
        if($notaDevolucion){
            $notaDevolucion->codigo_alterno = $notaDevolucion->codigo_factura;
            $notaDevolucion->codigo_factura = $notaDevolucion->codigo_factura .'-'.$notaDevolucion->id.'-ANULADO';
            $notaDevolucion->nota_alterna = 1; 
            $notaDevolucion->motivo = $motivo;
            if($notaDevolucion->update()){
                return true;
            } 
        }
        
        return false;
    }
}