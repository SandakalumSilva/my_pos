<?php

namespace App\Interfaces\Backend;

interface EmployeeInterface
{
    public function allEmployee();
    public function addEmployee();
    public function storeEmployee($request);
    public function editEmployee($id);
    public function updateEmployee($request);
    public function deleteEmploye($id);
}
