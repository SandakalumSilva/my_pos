<?php

namespace App\Repositories\Backend;

use App\Interfaces\Backend\SalaryInterface;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use App\Models\PaySalary;
use Carbon\Carbon;

class SalaryRepository implements SalaryInterface
{
    public function addAdvanceSalary()
    {
        $employees = Employee::latest()->get();
        return view('backend.salary.add_advance_salary', compact('employees'));
    }

    public function advanceSalaryStore($request)
    {
        $validateData = $request->validate([
            'employee_id' => 'required',
            'month' => ['required'],
            'year' => ['required'],
            'advance_salary' => ['required', 'max:255']
        ]);

        $month = $request->month;
        $employee_id = $request->employee_id;

        $advance = AdvanceSalary::where(['month' => $month])->where(['employee_id' => $employee_id])->first();

        if ($advance === null) {
            AdvanceSalary::insert([
                'employee_id' => $request->employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Advance Salary Paid Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.advance.salary')->with($notification);
        } else {
            $notification = array(
                'message' => 'Advance Salary Already Paid Successfully',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function allAdvanceSalary()
    {
        $salaries = AdvanceSalary::latest()->get();
        return view('backend.salary.all_advance_salary', compact('salaries'));
    }

    public function editAdvanceSalary($id)
    {
        $employees = Employee::latest()->get();
        $salary =  AdvanceSalary::findOrFail($id);
        return view('backend.salary.edit_advance_salary', compact('salary', 'employees'));
    }

    public function advanceSalaryUpdate($request)
    {
        $salaryId = $request->id;

        AdvanceSalary::findOrFail($salaryId)->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'advance_salary' => $request->advance_salary,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Advance Salary Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.advance.salary')->with($notification);
    }

    public function deleteAdvanceSalary($id)
    {
        AdvanceSalary::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Advance Salary Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.advance.salary')->with($notification);
    }

    public function paySalary()
    {
        $employees = Employee::latest()->get();
        return view('backend.salary.pay_salary', compact('employees'));
    }

    public function payNowSalary($id)
    {
        $paySalary = Employee::findOrFail($id);
        return view('backend.salary.paid_salary', compact('paySalary'));
    }

    public function employeSalaryStore($request)
    {
        $employeId = $request->id;

        PaySalary::insert([
            'employee_id' => $employeId,
            'salary_month' =>  $request->month,
            'paid_amount' => $request->paid_amount,
            'advance_salary' => $request->advance_salary,
            'due_salary' => $request->due_salary,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Employee Salary Paid Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pay.salary')->with($notification);
    }

    public function monthSalary()
    {
        $paidSalary = PaySalary::latest()->get();
        return view('backend.salary.month_salary', compact('paidSalary'));
    }
}
