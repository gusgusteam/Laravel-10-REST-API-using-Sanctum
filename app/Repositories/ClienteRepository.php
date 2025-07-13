<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Models\NotaDevolucion;
use App\Models\NotaVenta;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClienteRepository
{
    public function all()
    {
        return Cliente::all();
    }

    public function AllPaginated(array $filters, int $perPage , string $sortField, string $sortOrder)
    {
        $query = Cliente::query();
         // Filtrar por nombre
        if (!empty($filters['nombre'])) {
            $query->where(function ($query) use ($filters) {
                // Concatenamos los campos nombre, paterno, materno y buscamos en la cadena completa
                $query->whereRaw("CONCAT(nombre, ' ', paterno, ' ', materno) LIKE ?", ['%' . $filters['nombre'] . '%']);
            });
        }
        if (!empty($filters['paterno'])) {
            $query->orWhere('paterno', 'LIKE', '%' . $filters['paterno'] . '%');
        }
        if (!empty($filters['materno'])) {
            $query->orWhere('materno', 'LIKE', '%' . $filters['materno'] . '%');
        }
        if (!empty($filters['ci'])) {
            $query->orWhere('ci', 'LIKE', '%' . $filters['ci'] . '%');
        }
        if (!empty($filters['telefono'])) {
            $query->orWhere('telefono', 'LIKE', '%' . $filters['telefono'] . '%');
        }
        if (!empty($filters['codigo'])) {
            $query->orWhere('codigo', 'LIKE', '%' . $filters['codigo'] . '%');
        }
        if (!empty($filters['direccion'])) {
            $query->orWhere('direccion', 'LIKE', '%' . $filters['direccion'] . '%');
        }
        if(!empty($filters['estado'])){
            $query->where('estado', '=',$filters['estado']);
        }
        // Aplicar ordenación
        $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        return $query->paginate($perPage);
    }

    public function find($id)
    {
        return Cliente::findOrFail($id);
    }

    public function findByCodigo($codigo)
    {
        return Cliente::where('codigo', $codigo)->firstOrFail();
    }

    public function create(array $data)
    {
        if (!empty($data['image'])) {
            preg_match("/^data:image\/(\w+);base64,/", $data['image'], $matches);
            $extension = $matches[1] ?? 'png'; // por defecto 'png' si no se detecta
            $base64 = preg_replace("/^data:image\/\w+;base64,/", '', $data['image']);
            $base64 = str_replace(' ', '+', $base64); // Reemplaza espacios por '+'
            $decoded = base64_decode($base64);
            $fileName = 'imagen_' . Str::random(20) . '.' . $extension;
            // Guardar en el disco 'public' (storage/app/public)
            Storage::disk('public')->put('Cliente/' . $fileName, $decoded);
            $data['image'] = 'Cliente/' . $fileName;
        } else {
            $data['image'] = null;
        }
        return Cliente::create($data);
    }

    public function update($id, array $data)
    {
        $cliente = $this->find($id);
        if (!empty($data['image'])) {
            // Eliminar imagen anterior si existe
            if ($cliente->image && Storage::disk('public')->exists($cliente->image)) {
                Storage::disk('public')->delete($cliente->image);
            }
            // Procesar y guardar la nueva imagen
            preg_match("/^data:image\/(\w+);base64,/", $data['image'], $matches);
            $extension = $matches[1] ?? 'png'; 
            $base64 = preg_replace("/^data:image\/\w+;base64,/", '', $data['image']);
            $base64 = str_replace(' ', '+', $base64); 
            $decoded = base64_decode($base64);
            $fileName = 'imagen_' . Str::random(20) . '.' . $extension;
            Storage::disk('public')->put('Cliente/' . $fileName, $decoded);        
            $data['image'] = 'Cliente/' . $fileName;
        }else{
            $data['image'] = $cliente->image; // Mantener la imagen anterior si no se proporciona una nueva
        }
        $cliente->update($data);
        return $cliente;
    }

    public function destroy($id)
    {
        $cliente = $this->find($id);
        $cliente->update(['estado' => 0]);
        return $cliente;
    }

    public function restore($id)
    {
        $cliente = $this->find($id);
        $cliente->update(['estado' => 1]);
        return $cliente;
    }

    public function EstadoCuentaNotasCredito($clienteId,$gestionId)
    {
        $query = NotaVenta::where('cliente_id', $clienteId)
        ->where('estado', true)
        ->where('nota_alterna', false)
        ->where('venta_credito', true);

        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->sum('monto_total');
    }

    public function EstadoCuentaNotasContado($clienteId,$gestionId)
    {
        $query = NotaVenta::where('cliente_id', $clienteId)
        ->where('estado', true)
        ->where('nota_alterna', false)
        ->where('venta_credito', false);

        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->sum('monto_total');
    }

    public function EstadoCuentaNotasCreditoCantidad($clienteId,$gestionId)
    {
        $query = NotaVenta::where('cliente_id', $clienteId) 
        ->where('estado', true)
        ->where('nota_alterna', false)
        ->where('venta_credito', true);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function EstadoCuentaNotasContadoCantidad($clienteId,$gestionId)
    {
        $query = NotaVenta::where('cliente_id', $clienteId)
        ->where('estado', true)
        ->where('nota_alterna', false)
        ->where('venta_credito', false);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function EstadoCuentaNotasAnuladoCantidad($clienteId,$gestionId)
    {
        $query = NotaVenta::where('cliente_id', $clienteId)
        ->where('nota_alterna', true);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function EstadoCuentaNotasPendienteCantidad($clienteId,$gestionId)
    {
        $query = NotaVenta::where('cliente_id', $clienteId)
        ->where('estado', false)
        ->where('nota_alterna', false);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    // devoluciones 
    public function EstadoCuentaNotasContadoDevolucion($clienteId,$gestionId)
    {
        $query = NotaDevolucion::where('cliente_id', $clienteId)
        ->where('estado', true)
        ->where('nota_alterna', false);

        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->sum('monto_total');
    }

    public function EstadoCuentaNotasContadoCantidadDevolucion($clienteId,$gestionId)
    {
        $query = NotaDevolucion::where('cliente_id', $clienteId)
        ->where('estado', true)
        ->where('nota_alterna', false);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function EstadoCuentaNotasAnuladoCantidadDevolucion($clienteId,$gestionId)
    {
        $query = NotaDevolucion::where('cliente_id', $clienteId)
        ->where('nota_alterna', true);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function EstadoCuentaNotasPendienteCantidadDevolucion($clienteId,$gestionId)
    {
        $query = NotaDevolucion::where('cliente_id', $clienteId)
        ->where('estado', false)
        ->where('nota_alterna', false);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function PDF_ESTADO_CUENTA($clienteId,$gestionId)
    {
        $notaVenta = NotaVenta::with(
            'detallesVenta.productoEnvase.producto.categoria',
            'detallesVenta.productoEnvase.unidad'
        )
        ->where('cliente_id', $clienteId);
        if ($gestionId != -1) {
            $notaVenta->where('gestion_id', $gestionId);
        } 
        $notaVenta->where('venta_credito', 1);
        $notaVenta->where('nota_alterna', 0);
        $notaVenta->where('estado', 1);
        $result = $notaVenta->get();
    
        return $result;
    }

    public function PDF_ESTADO_CUENTA_DEVOLUCION($clienteId,$gestionId)
    {
        $notaDevolucion = NotaDevolucion::with(
            'detallesDevolucion.productoEnvase.producto.categoria',
            'detallesDevolucion.productoEnvase.unidad'
        )
        ->where('cliente_id', $clienteId);
        if ($gestionId != -1) {
            $notaDevolucion->where('gestion_id', $gestionId);
        } 
        $notaDevolucion->where('nota_alterna', 0);
        $notaDevolucion->where('estado', 1);
        $result = $notaDevolucion->get();
    
        return $result;
    }

}
