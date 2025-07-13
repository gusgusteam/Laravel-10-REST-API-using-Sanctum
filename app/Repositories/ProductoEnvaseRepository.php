<?php

namespace App\Repositories;

use App\Models\DetalleCompra;
use App\Models\DetalleVenta;
use App\Models\Gestion;
use App\Models\NotaCompra;
use App\Models\NotaDevolucion;
use App\Models\NotaVenta;
use App\Models\ProductoEnvase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductoEnvaseRepository
{
    public function AllPaginated(array $filters, int $perPage, string $sortField, string $sortOrder)
    {
        $notaVentaId = $filters['NotaVenta_id'] ?? null; // Obtener el ID de la nota de venta del filtro
        $notaDevolucionId = $filters['NotaDevolucion_id'] ?? null; // Obtener el ID de la nota de devolución del filtro
        $notaCompraId = $filters['NotaCompra_id'] ?? null; // Obtener el ID de la nota de venta del filtro

        $query = ProductoEnvase::with(['producto.categoria','producto.tipoProducto', 'unidad']); // Carga relaciones

         // Buscar por nombre de producto si se proporciona
        if (!empty($filters['producto'])) {
            $query->whereHas('producto', function ($q) use ($filters) {
                $q->where('nombre', 'like', '%' . $filters['producto'] . '%');
            });
        }

        // Buscar por nombre de categoría si se proporciona
        if (!empty($filters['categoria']) && $filters['categoria'] !== 'null') {
            $query->whereHas('producto.categoria', function ($q) use ($filters) {
                $q->where('nombre', '=',$filters['categoria']);
            });
        }
        if(!empty($filters['estado'])){
            $query->where('estado', '=',$filters['estado']);
        }

        // Aplicar ordenación
        $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        $paginated = $query->paginate($perPage);
        // Si hay nota de venta, verificamos producto por producto
        if ($notaVentaId) {
            $notaVenta = NotaVenta::find($notaVentaId);
            if ($notaVenta) {
                $paginated->getCollection()->transform(function ($item) use ($notaVenta) {
                    $item->selectedNota = $notaVenta->PerteneceProductoEnvase($item->id);
                    return $item;
                });
            }
        }

        if ($notaDevolucionId) {
            $notaDevolucion = NotaDevolucion::find($notaDevolucionId);
            if ($notaDevolucion) {
                $paginated->getCollection()->transform(function ($item) use ($notaDevolucion) {
                    $item->selectedNota = $notaDevolucion->PerteneceProductoEnvase($item->id);
                    return $item;
                });
            }
        }

        if ($notaCompraId) {
            $notaCompra = NotaCompra::find($notaCompraId);
            if ($notaCompra) {
                $paginated->getCollection()->transform(function ($item) use ($notaCompra) {
                    $item->selectedNota = $notaCompra->PerteneceProductoEnvase($item->id);
                    return $item;
                });
            }
        }

        return $paginated;
    }

    public function create(array $data)
    {
        if (!empty($data['image'])) {
            // Extraer la extensión
            preg_match("/^data:image\/(\w+);base64,/", $data['image'], $matches);
            $extension = $matches[1] ?? 'png'; // por defecto 'png' si no se detecta
        
            // Limpiar el base64
            $base64 = preg_replace("/^data:image\/\w+;base64,/", '', $data['image']);
            $base64 = str_replace(' ', '+', $base64); // Reemplaza espacios por '+'
        
            // Decodificar
            $decoded = base64_decode($base64);
        
            // Generar nombre único
            $fileName = 'imagen_' . Str::random(20) . '.' . $extension;
        
            // Guardar en el disco 'public' (storage/app/public)
            Storage::disk('public')->put('ProductoEnvase/' . $fileName, $decoded);
        
            // Guardar nombre en la base de datos
            $data['image'] = 'ProductoEnvase/' . $fileName;
        } else {
            $data['image'] = null;
        }
        return ProductoEnvase::create($data);
    }

    public function update($id, array $data)
    {
        $productoEnvase = $this->find($id);
            // Verificar si se subió una nueva imagen
        if (!empty($data['image'])) {
            // Eliminar imagen anterior si existe
            if ($productoEnvase->image && Storage::disk('public')->exists($productoEnvase->image)) {
                Storage::disk('public')->delete($productoEnvase->image);
            }
            // Procesar y guardar la nueva imagen
            preg_match("/^data:image\/(\w+);base64,/", $data['image'], $matches);
            $extension = $matches[1] ?? 'png'; 
            $base64 = preg_replace("/^data:image\/\w+;base64,/", '', $data['image']);
            $base64 = str_replace(' ', '+', $base64); 
            $decoded = base64_decode($base64);
            $fileName = 'imagen_' . Str::random(20) . '.' . $extension;
            Storage::disk('public')->put('ProductoEnvase/' . $fileName, $decoded);        
            $data['image'] = 'ProductoEnvase/' . $fileName;
        }else{
            $data['image'] = $productoEnvase->image; // Mantener la imagen anterior si no se proporciona una nueva
        }
        $productoEnvase->update($data);
        return $productoEnvase;
    }

    public function all()
    {
        return ProductoEnvase::with(['producto', 'unidad'])->get();
    }

    public function find($id)
    {
        //return ProductoEnvase::findOrFail($id)->load('producto', 'unidad');
        return ProductoEnvase::with(['producto', 'unidad'])->findOrFail($id);
    }

    public function destroy($id)
    {
        $productoEnvase = $this->find($id);
        $productoEnvase->update(['estado' => 0]);
        return $productoEnvase;
    }

    public function restore($id)
    {
        $productoEnvase = $this->find($id);
        $productoEnvase->update(['estado' => 1]);
        return $productoEnvase;
    }

    public function inventario(array $filters, int $perPage, string $sortField, string $sortOrder){
        $query = ProductoEnvase::with(['producto.categoria','producto.tipoProducto', 'unidad']); // Carga relaciones
         // Buscar por nombre de producto si se proporciona
        if (!empty($filters['producto'])) {
            $query->whereHas('producto', function ($q) use ($filters) {
                $q->where('nombre', 'like', '%' . $filters['producto'] . '%');
            });
        }

        // Buscar por nombre de categoría si se proporciona
        if (!empty($filters['categoria']) && $filters['categoria'] !== 'null') {
            $query->whereHas('producto.categoria', function ($q) use ($filters) {
                $q->where('nombre', '=',$filters['categoria']);
            });
        }
        if(!empty($filters['estado'])){
            $query->where('estado', '=',$filters['estado']);
        }

        // Aplicar ordenación
        $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        $paginated = $query->paginate($perPage);
        $paginated->getCollection()->transform(function ($item) { // calcular stock actual
            $id = $item->id;
            // Total vendido
            $totalVendido = DetalleVenta::where('producto_envase_id', $id)
                ->whereHas('notaVenta', fn($q) => 
                $q->where('estado', true)
                ->where('nota_alterna', false)
                ->where('gestion_id', Gestion::where('gestion_actual', true)->first()->id ) // Filtrar por gestión actual
                )
                ->sum('cantidad');
        
            // Total comprado
            $totalComprado = DetalleCompra::where('producto_envase_id', $id)
                ->whereHas('notaCompra', fn($q) => 
                $q->where('estado', true)
                ->where('nota_alterna', false)
                ->where('gestion_id', Gestion::where('gestion_actual', true)->first()->id) // Filtrar por gestión actual
                )
                ->sum('cantidad');
        
            $item->sumTotalProductoVendido = $totalVendido;
            $item->sumTotalProductoComprado = $totalComprado;
            $item->stockActual = $totalComprado - $totalVendido;
        
            return $item;
        });
        
        return $paginated;
    }
}
