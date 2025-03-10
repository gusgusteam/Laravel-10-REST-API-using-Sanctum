<?php

namespace App\Http\Controllers\API\administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\AssignPermissionRequest;
use App\Http\Requests\Role\RemovePermissionRequest;
use App\Http\Requests\User\AssignRoleRequest;
use App\Http\Requests\User\RemoveRoleRequest;
use App\Http\Resources\AdminUserResource;
use App\Models\User;
//use App\Models\Role;
use Spatie\Permission\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    protected $roleService;
    protected $userService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    // Asignar permiso a un rol
    public function assignPermission(AssignPermissionRequest $request, $id_rol): JsonResponse
    {
        $role=$this->roleService->find($id_rol);
        $role->givePermissionTo($request->permission);
        return response()->json(['message' => 'Permiso asignado correctamente.'], 200);
    }

    // Quitar permiso de un rol
    public function removePermission(RemovePermissionRequest $request, $id_rol): JsonResponse
    {
        $role=$this->roleService->find($id_rol);
        $role->revokePermissionTo($request->permission);

        return response()->json(['message' => 'Permiso quitado correctamente.'], 200);
    }

    // Asignar rol a un usuario
    public function assignRole(AssignRoleRequest $request, $id_user): JsonResponse
    {
        $user = $this->userService->find($id_user);
        $rol = Role::where('name', $request->role)->first();
        $rol->guard_name='web';
        $rol->update();
        $user->assignRole($rol->name);
        $rol = Role::where('name', $request->role)->first();
        $rol->guard_name='sanctum';
        $rol->update();
        return response()->json(['message' => 'Rol asignado correctamente.'], 200);
    }

    // Quitar rol de un usuario
    public function removeRole(RemoveRoleRequest $request, $id_user): JsonResponse
    {
        $user = $this->userService->find($id_user);
        $rol = Role::where('name', $request->role)->first();
        $rol->guard_name='web';
        $rol->update();
        $user->removeRole($request->role);
        $rol = Role::where('name', $request->role)->first();
        $rol->guard_name='sanctum';
        $rol->update();
        return response()->json(['message' => 'Rol quitado correctamente.'], 200);
    }

    public function usersByRole(): JsonResponse
    {
        return response()->json(AdminUserResource::collection(User::with('roles')->get()), 200);
    }
}
