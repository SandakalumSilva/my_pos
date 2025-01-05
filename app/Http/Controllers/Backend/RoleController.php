<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\RoleInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function allPermission()
    {
        return $this->roleRepository->allPermission();
    }

    public function addPermission()
    {
        return $this->roleRepository->addPermission();
    }

    public function storePermission(Request $request)
    {
        return $this->roleRepository->storePermission($request);
    }

    public function editPermission($id)
    {
        return $this->roleRepository->editPermission($id);
    }

    public function updatePermission(Request $request)
    {
        return $this->roleRepository->updatePermission($request);
    }

    public function deletePermission($id)
    {
        return $this->roleRepository->deletePermission($id);
    }

    public function allRoles()
    {
        return $this->roleRepository->allRoles();
    }

    public function addRoles()
    {
        return $this->roleRepository->addRoles();
    }

    public function storeRoles(Request $request)
    {
        return $this->roleRepository->storeRoles($request);
    }

    public function editRoles($id)
    {
        return $this->roleRepository->editRoles($id);
    }

    public function updateRoles(Request $request)
    {
        return $this->roleRepository->updateRoles($request);
    }

    public function deleteRole($id)
    {
        return $this->roleRepository->deleteRole($id);
    }

    public function addRolesPermission()
    {
        return $this->roleRepository->addRolesPermission();
    }

    public function storeRolePermission(Request $request)
    {
        return $this->roleRepository->storeRolePermission($request);
    }

    public function allRolePermission()
    {
        return $this->roleRepository->allRolePermission();
    }

    public function adminEditRoles($id)
    {
        return $this->roleRepository->adminEditRoles($id);
    }

    public function rolePermissionUpdate(Request $request, $id)
    {
        return $this->roleRepository->rolePermissionUpdate($request, $id);
    }

    public function adminDeleteRoles($id){
        return $this->roleRepository->adminDeleteRoles($id);
    }
}
