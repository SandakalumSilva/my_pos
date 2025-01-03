<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\ExpenseInterface;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    protected $expenseRepository;

    public function __construct(ExpenseInterface $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    public function addExpense(){
        return $this->expenseRepository->addExpense();
    }

    public function storeExpense(Request  $request){
        return $this->expenseRepository->storeExpense($request);
    }

    public function todayExpense(){
        return $this->expenseRepository->todayExpense();
    }

    public function editExpense($id){
        return $this->expenseRepository->editExpense($id);
    }

    public function updateExpense(Request $request){
        return $this->expenseRepository->updateExpense($request);
    }

    public function monthExpense(){
        return $this->expenseRepository->monthExpense();
    }

}
