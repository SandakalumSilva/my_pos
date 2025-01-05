<?php

namespace App\Interfaces\Backend;

interface RoleInterface
{

    public function allPermission();
    public function addPermission();
    public function storePermission($request);
    public function editPermission($id);
    public function updatePermission($request);
    public function deletePermission($id);
    public function allRoles();
    public function addRoles();
    public function storeRoles($request);
    public function editRoles($id);
    public function updateRoles($request);
    public function deleteRole($id);
    public function addRolesPermission();
    public function storeRolePermission($request);
    public function allRolePermission();
    public function adminEditRoles($id);
    public function rolePermissionUpdate($request, $id);
    public function adminDeleteRoles($id);
}
