<?php 
namespace App\Interfaces\Backend;

interface ExpenseInterface{
    public function addExpense();
    public function storeExpense($request);
    public function todayExpense();
    public function editExpense($id);
    public function updateExpense($request);
    public function monthExpense();
}