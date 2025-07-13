<?php

namespace App\Repositories;

use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConfiguracionRepository
{
    protected $GestionRepository;
    public function __construct(GestionRepository $GestionRepository)
    {
        $this->GestionRepository = $GestionRepository;
    }

    public function find($id){
        return Configuracion::findOrFail($id);
    }
    public function update($id, array $data)
    {
        $configuracion = $this->find($id);
            // Verificar si se subió una nueva imagen
        if (!empty($data['logo'])) {
            // Eliminar logon anterior si existe
            if ($configuracion->logo && Storage::disk('public')->exists($configuracion->logo)) {
                Storage::disk('public')->delete($configuracion->logo);
            }
            // Procesar y guardar la nueva imagen
            preg_match("/^data:image\/(\w+);base64,/", $data['logo'], $matches);
            $extension = $matches[1] ?? 'png'; 
            $base64 = preg_replace("/^data:image\/\w+;base64,/", '', $data['logo']);
            $base64 = str_replace(' ', '+', $base64); 
            $decoded = base64_decode($base64);
            $fileName = 'imagen_' . Str::random(20) . '.' . $extension;
            Storage::disk('public')->put('ConfiguracionLogo/' . $fileName, $decoded);        
            $data['logo'] = 'ConfiguracionLogo/' . $fileName;
        }else{
            $data['logo'] = $configuracion->logo; 
        }
        $this->GestionRepository->actual($data['id_gestion']);
        $configuracion->update($data);
        return $configuracion;
    }

    public function obtenerLogoBase64()
    {
        $path = public_path('storage/ConfiguracionLogo/logo.png');

        if (!file_exists($path)) {
            return response()->json(['error' => 'Logo no encontrado'], 404);
        }

        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return response()->json($base64, 200);
    }

}
