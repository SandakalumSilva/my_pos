<?php

namespace App\Repositories\Backend;

use App\Interfaces\Backend\CustomerInterface;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CustomerRepository implements CustomerInterface
{

    public function allCustomer()
    {
        $customers = Customer::latest()->get();
        return view('backend.customer.all_customer', compact('customers'));
    }

    public function addCustomer()
    {
        return view('backend.customer.add_customer');
    }

    public function storeCustomer($request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'unique:customers', 'max:200'],
            'phone' => ['required', 'max:200'],
            'address' => ['required', 'max:400'],
            'account_holder' => ['required', 'max:200'],
            'account_number' => ['required', 'max:200']
        ]);

        $manager = new ImageManager(new Driver());

        if ($request->file('image')) {
            $image = $request->file('image');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $file = $manager->read($image);
            $file->resize(300, 300)->save('upload/customer/' . $nameGen);

            $saveUrl = 'upload/customer/' . $nameGen;
        } else {
            $saveUrl = '';
        }



        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'image' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Customer Inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.customer')->with($notification);
    }

    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.edit_customer', compact('customer'));
    }

    public function updateCustomer($request)
    {
        $customerId = $request->id;
        $manager = new ImageManager(new Driver());

        if ($request->file('image')) {
            $image = $request->file('image');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $file = $manager->read($image);
            $file->resize(300, 300)->save('upload/customer/' . $nameGen);

            $saveUrl = 'upload/customer/' . $nameGen;

            Customer::findOrFail($customerId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'image' => $saveUrl,
                'created_at' => Carbon::now(),
            ]);
        } else {
            Customer::findOrFail($customerId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Customer Updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.customer')->with($notification);
    }

    public function deleteCustomer($id)
    {
        $customerImg = Customer::findOrFail($id);
        $img = $customerImg->image;
        unlink($img);

        Customer::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
