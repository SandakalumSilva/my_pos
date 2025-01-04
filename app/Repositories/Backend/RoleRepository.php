<?php

namespace App\Repositories\Backend;

use App\Interfaces\Backend\RoleInterface;
use Spatie\Permission\Models\Permission;

class RoleRepository implements RoleInterface
{

    public function allPermission()
    {
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }

    public function addPermission()
    {
        return view('backend.pages.permission.add_permission');
    }

    public function storePermission($request)
    {
        $role = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        $notification = array(
            'message' => 'Permission Added Successfully',
            'alert0type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));
    }

    public function updatePermission($request)
    {
        $perId = $request->id;

        Permission::findOrFail($perId)->update([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert0type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function deletePermission($id)
    {
        Permission::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert0type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }
}
