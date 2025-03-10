<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function getAll()
    {
        return Permission::all();
    }

    public function findById($id)
    {
        return Permission::find($id);
    }

    public function create(array $data)
    {
        return Permission::create($data);
    }

    public function update(Permission $permission, array $data)
    {
        $permission->update($data);
        return $permission;
    }

    public function delete(Permission $permission)
    {
        return $permission->delete();
    }
}
