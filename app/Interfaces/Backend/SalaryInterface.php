<?php 
namespace App\Interfaces\Backend;

interface SalaryInterface{
    public function addAdvanceSalary();
    public function advanceSalaryStore($request);
    public function allAdvanceSalary();
    public function editAdvanceSalary($id);
    public function advanceSalaryUpdate($request);
    public function deleteAdvanceSalary($id);
    public function paySalary();
    public function payNowSalary($id);
    public function employeSalaryStore($request);
    public function monthSalary();
}