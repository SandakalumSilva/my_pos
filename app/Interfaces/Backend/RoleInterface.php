<?php 
namespace App\Interfaces\Backend;

interface RoleInterface{

    public function allPermission();
    public function addPermission();
    public function storePermission($request);
    public function editPermission($id);
    public function updatePermission($request);
    public function deletePermission($id);
}