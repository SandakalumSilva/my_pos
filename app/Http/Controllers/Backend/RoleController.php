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

    public function deletePermission($id){
        return $this->roleRepository->deletePermission($id);
    }
}
