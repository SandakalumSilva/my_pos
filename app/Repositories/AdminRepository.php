<?php

namespace App\Repositories;

use App\Interfaces\AdminInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}
