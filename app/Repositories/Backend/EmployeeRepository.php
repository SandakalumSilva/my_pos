<?php

namespace App\Repositories\Backend;

use App\Interfaces\Backend\EmployeeInterface;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EmployeeRepository implements EmployeeInterface
{
    public function allEmployee()
    {
        $employees = Employee::latest()->get();
        return view('backend.employee.all_employee', compact('employees'));
    }

    public function addEmployee()
    {
        return view('backend.employee.add_employee');
    }

    public function storeEmployee($request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'unique:employees', 'max:200'],
            'phone' => ['required', 'max:200'],
            'address' => ['required', 'max:400'],
            'salary' => ['required', 'max:200'],
            'vacation' => ['required', 'max:200']
        ]);

        $manager = new ImageManager(new Driver());

        if ($request->file('image')) {
            $image = $request->file('image');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $file = $manager->read($image);
            $file->resize(300, 300)->save('upload/employee/' . $nameGen);

            $saveUrl = 'upload/employee/' . $nameGen;
        } else {
            $saveUrl = '';
        }



        Employee::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
            'image' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Employee Inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.employee')->with($notification);
    }

    public function editEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit_employee', compact('employee'));
    }

    public function updateEmployee($request)
    {
        $employeeId = $request->id;
        $manager = new ImageManager(new Driver());

        if ($request->file('image')) {
            $image = $request->file('image');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $file = $manager->read($image);
            $file->resize(300, 300)->save('upload/employee/' . $nameGen);

            $saveUrl = 'upload/employee/' . $nameGen;
        } else {
            $saveUrl = '';
        }

        Employee::findOrFail($employeeId)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
            'image' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Employee Updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.employee')->with($notification);
    }

    public function deleteEmploye($id)
    {
        $employeeImg = Employee::findOrFail($id);
        $img = $employeeImg->image;
        unlink($img);

        Employee::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Employee Deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
