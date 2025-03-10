<?php

namespace App\Services;

use App\Repositories\NotaVentaRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class NotaVentaService
{
    protected $notaVentaRepository;

    public function __construct(NotaVentaRepository $notaVentaRepository)
    {
        $this->notaVentaRepository = $notaVentaRepository;
    }

    public function getAll()
    {
        return $this->notaVentaRepository->all();
    }

    public function find($id)
    {
        return $this->notaVentaRepository->find($id);
    }

    public function create($data)
    {
        //return DB::transaction(function () use ($data) {
            return $this->notaVentaRepository->create($data);
        //});
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            return $this->notaVentaRepository->update($id, $data);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            return $this->notaVentaRepository->destroy($id);
        });
    }

    public function restore($id)
    {
        return DB::transaction(function () use ($id) {
            return $this->notaVentaRepository->restore($id);
        });
    }
}