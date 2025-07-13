<?php

namespace App\Repositories;

use App\Models\NotaCompra;
use App\Models\NotaDevolucion;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProveedorRepository
{
    public function all()
    {
        return Proveedor::all();
    }

    public function AllPaginated(array $filters, int $perPage , string $sortField, string $sortOrder)
    {
        $query = Proveedor::query();
        if (!empty($filters['razon_social'])) {
            $query->orWhere('razon_social', 'LIKE', '%' . $filters['razon_social'] . '%');
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
        if (!empty($filters['correo'])) {
            $query->orWhere('correo', 'LIKE', '%' . $filters['correo'] . '%');
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
        return Proveedor::findOrFail($id);
    }

    public function findByCodigo($codigo)
    {
        return Proveedor::where('codigo', $codigo)->firstOrFail();
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
            Storage::disk('public')->put('Proveedor/' . $fileName, $decoded);
            $data['image'] = 'Proveedor/' . $fileName;
        } else {
            $data['image'] = null;
        }
        return Proveedor::create($data);
    }

    public function update($id, array $data)
    {
        $proveedor = $this->find($id);
        if (!empty($data['image'])) {
            // Eliminar imagen anterior si existe
            if ($proveedor->image && Storage::disk('public')->exists($proveedor->image)) {
                Storage::disk('public')->delete($proveedor->image);
            }
            // Procesar y guardar la nueva imagen
            preg_match("/^data:image\/(\w+);base64,/", $data['image'], $matches);
            $extension = $matches[1] ?? 'png'; 
            $base64 = preg_replace("/^data:image\/\w+;base64,/", '', $data['image']);
            $base64 = str_replace(' ', '+', $base64); 
            $decoded = base64_decode($base64);
            $fileName = 'imagen_' . Str::random(20) . '.' . $extension;
            Storage::disk('public')->put('Proveedor/' . $fileName, $decoded);        
            $data['image'] = 'Proveedor/' . $fileName;
        }else{
            $data['image'] = $proveedor->image; // Mantener la imagen anterior si no se proporciona una nueva
        }
        $proveedor->update($data);
        return $proveedor;
    }

    public function destroy($id)
    {
        $proveedor = $this->find($id);
        $proveedor->update(['estado' => 0]);
        return $proveedor;
    }

    public function restore($id)
    {
        $proveedor = $this->find($id);
        $proveedor->update(['estado' => 1]);
        return $proveedor;
    }

    public function EstadoCuentaNotasCredito($proveedorId,$gestionId)
    {
        $query = NotaCompra::where('proveedor_id', $proveedorId)
        ->where('estado', true)
        ->where('nota_alterna', false)
        ->where('compra_credito', true);

        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->sum('monto_total');
    }

    public function EstadoCuentaNotasContado($proveedorId,$gestionId)
    {
        $query = NotaCompra::where('proveedor_id', $proveedorId)
        ->where('estado', true)
        ->where('nota_alterna', false)
        ->where('compra_credito', false);

        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->sum('monto_total');
    }

    public function EstadoCuentaNotasCreditoCantidad($proveedorId,$gestionId)
    {
        $query = NotaCompra::where('proveedor_id', $proveedorId) 
        ->where('estado', true)
        ->where('nota_alterna', false)
        ->where('compra_credito', true);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function EstadoCuentaNotasContadoCantidad($proveedorId,$gestionId)
    {
        $query = NotaCompra::where('proveedor_id', $proveedorId)
        ->where('estado', true)
        ->where('nota_alterna', false)
        ->where('compra_credito', false);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function EstadoCuentaNotasAnuladoCantidad($proveedorId,$gestionId)
    {
        $query = NotaCompra::where('proveedor_id', $proveedorId)
        ->where('nota_alterna', true);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function EstadoCuentaNotasPendienteCantidad($proveedorId,$gestionId)
    {
        $query = NotaCompra::where('proveedor_id', $proveedorId)
        ->where('estado', false)
        ->where('nota_alterna', false);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    // devoluciones 
    public function EstadoCuentaNotasContadoDevolucion($proveedorId,$gestionId)
    {
        $query = NotaDevolucion::where('proveedor_id', $proveedorId)
        ->where('estado', true)
        ->where('nota_alterna', false);

        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->sum('monto_total');
    }

    public function EstadoCuentaNotasContadoCantidadDevolucion($proveedorId,$gestionId)
    {
        $query = NotaDevolucion::where('proveedor_id', $proveedorId)
        ->where('estado', true)
        ->where('nota_alterna', false);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function EstadoCuentaNotasAnuladoCantidadDevolucion($proveedorId,$gestionId)
    {
        $query = NotaDevolucion::where('proveedor_id', $proveedorId)
        ->where('nota_alterna', true);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function EstadoCuentaNotasPendienteCantidadDevolucion($proveedorId,$gestionId)
    {
        $query = NotaDevolucion::where('proveedor_id', $proveedorId)
        ->where('estado', false)
        ->where('nota_alterna', false);
        if ($gestionId != -1) {
            $query->where('gestion_id', $gestionId);
        }
        return $query->count();
    }

    public function PDF_ESTADO_CUENTA($proveedorId,$gestionId)
    {
        $notaCompra = NotaCompra::with(
            'detallesCompra.productoEnvase.producto.categoria',
            'detallesCompra.productoEnvase.unidad'
        )
        ->where('proveedor_id', $proveedorId);
        if ($gestionId != -1) {
            $notaCompra->where('gestion_id', $gestionId);
        } 
        $notaCompra->where('compra_credito', 1);
        $notaCompra->where('nota_alterna', 0);
        $notaCompra->where('estado', 1);
        $result = $notaCompra->get();
    
        return $result;
    }

    public function PDF_ESTADO_CUENTA_DEVOLUCION($proveedorId,$gestionId)
    {
        $notaDevolucion = NotaDevolucion::with(
            'detallesDevolucion.productoEnvase.producto.categoria',
            'detallesDevolucion.productoEnvase.unidad'
        )
        ->where('proveedor_id', $proveedorId);
        if ($gestionId != -1) {
            $notaDevolucion->where('gestion_id', $gestionId);
        } 
        $notaDevolucion->where('nota_alterna', 0);
        $notaDevolucion->where('estado', 1);
        $result = $notaDevolucion->get();
    
        return $result;
    }

}
