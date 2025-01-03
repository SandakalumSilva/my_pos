<?php

namespace App\Repositories\Backend;

use App\Interfaces\Backend\SupplierInterface;
use App\Models\Supplier;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SupplierRepository implements SupplierInterface
{
    public function allSupplier()
    {
        $suppliers = Supplier::latest()->get();
        return view('backend.supplier.all_supplier', compact('suppliers'));
    }

    public function addSupplier()
    {
        return view('backend.supplier.add_supplier');
    }

    public function storeSupplier($request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'unique:suppliers', 'max:200'],
            'phone' => ['required', 'max:200'],
            'address' => ['required', 'max:400'],
            'account_holder' => ['required', 'max:200'],
            'account_number' => ['required', 'max:200'],
            'type' => ['required'],
        ]);

        $manager = new ImageManager(new Driver());

        if ($request->file('image')) {
            $image = $request->file('image');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $file = $manager->read($image);
            $file->resize(300, 300)->save('upload/supplier/' . $nameGen);

            $saveUrl = 'upload/supplier/' . $nameGen;
        } else {
            $saveUrl = '';
        }



        Supplier::insert([
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
            'type' => $request->type,
            'image' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Supplier Inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.supplier')->with($notification);
    }

    public function detailsSupplier($id){
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.details_supplier', compact('supplier'));
    }

    public function editSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit_supplier', compact('supplier'));
    }

    public function updateSupplier($request)
    {
        $supplierId = $request->id;
        $manager = new ImageManager(new Driver());

        if ($request->file('image')) {
            $image = $request->file('image');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $file = $manager->read($image);
            $file->resize(300, 300)->save('upload/supplier/' . $nameGen);

            $saveUrl = 'upload/supplier/' . $nameGen;

            Supplier::findOrFail($supplierId)->update([
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
                'type' => $request->type,
                'image' => $saveUrl,
                'created_at' => Carbon::now(),
            ]);
        } else {
            Supplier::findOrFail($supplierId)->update([
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
                'type' => $request->type,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Supplier Updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.supplier')->with($notification);
    }

    public function deleteSupplier($id)
    {
        $supplierImg = Supplier::findOrFail($id);
        $img = $supplierImg->image;
        unlink($img);

        Supplier::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Supplier Deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
