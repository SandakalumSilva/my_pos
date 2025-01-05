<?php

namespace App\Repositories;

use App\Interfaces\AdminInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminRepository implements AdminInterface
{

    public function adminDestroy($request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin logout successfully.',
            'alert-type' => 'info'
        );

        return redirect()->route('admin.logout.page')->with($notification);
    }

    public function adminLogoutPage()
    {
        return view('admin.admin_logout');
    }

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function adminProfileStore($request)
    {
        $id = Auth::User()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('adminProfile')) {
            $file = $request->file('adminProfile');
            @unlink(public_path('upload/admin_image' . $data->photo));
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'), $fileName);
            $data['photo'] = $fileName;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin profile updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function changePassword()
    {
        return view('admin.change_password');
    }

    public function updatePassword($request)
    {
        ///validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        //Match the old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old password dose not match.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        ///Update the new password

        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password change Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    ///// Admin User all method /////
    public function allAdmin()
    {
        $alladminuser = User::latest()->get();
        return view('backend.admin.all_admin', compact('alladminuser'));
    }

    public function addAdmin()
    {
        $roles = Role::all();
        return view('backend.admin.add_admin', compact('roles'));
    }

    public function storeAdmin($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'New User Created Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function editAdmin($id)
    {
        $roles = Role::all();
        $adminuser = User::findOrFail($id);
        return view('backend.admin.edit_admin', compact('roles', 'adminuser'));
    }

    public function updateUser($request)
    {
        $userId = $request->id;
        $user = User::findOrFail($userId);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'User Updated Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function deleteUser($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => 'User Deleted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    }
}
