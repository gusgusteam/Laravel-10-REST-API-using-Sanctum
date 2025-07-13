<?php

namespace App\Services;

use App\Repositories\ConfiguracionRepository;

class ConfiguracionService
{
    protected $ConfiguracionRepository;

    public function __construct(ConfiguracionRepository $ConfiguracionRepository)
    {
        $this->ConfiguracionRepository = $ConfiguracionRepository;
    }

    public function find($id)
    {
        return $this->ConfiguracionRepository->find($id);
    }

    public function update($id, $data)
    {
        return $this->ConfiguracionRepository->update($id, $data);
    }

    public function obtenerLogoBase64()
    {
        return $this->ConfiguracionRepository->obtenerLogoBase64();
    }

}
