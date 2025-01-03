<?php

namespace App\Repositories\Backend;

use App\Interfaces\Backend\AttendenceInterface;
use App\Models\Attendence;
use App\Models\Employee;

class AttendenceRepository implements AttendenceInterface
{

    public function employeeAttendenceList()
    {
        $allDatas = Attendence::select('date')->groupBy('date')->orderBy('date', 'desc')->get();
        return view('backend.attendence.view_employee_attend', compact('allDatas'));
    }

    public function AddEmployeeAttendence()
    {
        $employees = Employee::all();
        return view('backend.attendence.add_employee_attend', compact('employees'));
    }

    public function employeeAttendenceStore($request)
    {

        Attendence::where('date', date('Y-m-d', strtotime($request->date)))->delete();

        $countEmployee = count($request->employee_id);

        for ($i = 0; $i < $countEmployee; $i++) {
            $attend_status = 'attend_status' . $i;
            Attendence::create([
                'date' => date('Y-m-d', strtotime($request->date)),
                'employee_id' => $request->employee_id[$i],
                'attend_status' => $request->$attend_status
            ]);
        }

        $notification = array(
            'message' => 'Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.attend.list')->with($notification);
    }

    public function editEmployeeAttendence($date)
    {
        $employees = Employee::all();
        $editData = Attendence::where('date', $date)->get();
        return view('backend.attendence.edit_employee_attend', compact('employees', 'editData'));
    }

    public function viewEmployeeAttendence($date)
    {
        $details = Attendence::where('date', $date)->get();
        return view('backend.attendence.details_employee_attend', compact('details'));
    }
}
