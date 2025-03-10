<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAll()
    {
        return $this->roleRepository->getAll();
    }

    public function find($id)
    {
        return $this->roleRepository->find($id);
    }

    public function create(array $data)
    {
        //$data['guard_name'] = 'web';
        return $this->roleRepository->create($data);
    }

    public function update($id, array $data)
    {
        $role = $this->find($id);
        return $this->roleRepository->update($role, $data);
    }

    public function delete($id)
    {
        $role = $this->find($id);
        return $this->roleRepository->delete($role);
    }

    
}
