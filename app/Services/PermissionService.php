<?php

namespace App\Services;

use App\Repositories\PermissionRepository;
use Spatie\Permission\Models\Permission;

class PermissionService
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function getAll()
    {
        return $this->permissionRepository->getAll();
    }

    public function findById($id)
    {
        return $this->permissionRepository->findById($id);
    }

    public function create(array $data)
    {
        //$data['guard_name'] = 'web';
        return $this->permissionRepository->create($data);
    }

    public function update($id, array $data)
    {
        $permission = $this->findById($id);
        return $this->permissionRepository->update($permission, $data);
    }

    public function delete($id)
    {
        $permission = $this->findById($id);
        return $this->permissionRepository->delete($permission);
    }
}
