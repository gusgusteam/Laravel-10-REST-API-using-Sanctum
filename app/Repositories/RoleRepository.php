<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function getAll()
    {
        return Role::all();
    }

    public function find($id)
    {
        return Role::findById($id);
    }

    public function create(array $data)
    {
        return Role::create($data);
    }

    public function update(Role $role, array $data)
    {
        $role->update($data);
        return $role;
    }

    public function delete(Role $role)
    {
        return $role->delete();
    }
    
}
