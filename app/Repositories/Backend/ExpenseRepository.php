<?php

namespace App\Repositories\Backend;

use App\Interfaces\Backend\ExpenseInterface;
use App\Models\Expense;
use Illuminate\Support\Carbon;

class ExpenseRepository implements ExpenseInterface
{

    public function addExpense()
    {
        return view('backend.expense.add_expense');
    }

    public function storeExpense($request)
    {
        $validate = $request->validate([
            'details' => 'required',
            'amount' => 'required'
        ]);
        Expense::insert([
            'details' => $request->details,
            'amount' => $request->amount,
            'month' => $request->month,
            'year' => $request->year,
            'date' => $request->date,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Expense Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function todayExpense()
    {
        $date = date("d-m-Y");
        $today = Expense::where('date', $date)->get();
        $expense = Expense::where('date', $date)->sum('amount');
        return view('backend.expense.today_expense', compact('today', 'expense'));
    }

    public function editExpense($id)
    {
        $expense = Expense::findOrFail($id);
        return view('backend.expense.edit_expense', compact('expense'));
    }

    public function updateExpense($request)
    {
        $validate = $request->validate([
            'details' => 'required',
            'amount' => 'required'
        ]);

        $expenseId = $request->id;
        Expense::findOrFail($expenseId)->update([
            'details' => $request->details,
            'amount' => $request->amount,
            'month' => $request->month,
            'year' => $request->year,
            'date' => $request->date,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Expense Updated Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('today.expense')->with($notification);
    }

    public function monthExpense()
    {
        $month = date("F");
        $monthexpense = Expense::where('month', $month)->get();
        $expense = Expense::where('month', $month)->sum('amount');
        return view('backend.expense.month_expense', compact('monthexpense', 'expense'));
    }
}
