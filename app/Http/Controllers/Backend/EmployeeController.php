<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\EmployeeInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeRepository;

    public function __construct(EmployeeInterface $employeeInterface)
    {
        $this->employeeRepository = $employeeInterface;
    }

    public function allEmployee()
    {
        return $this->employeeRepository->allEmployee();
    }

    public function addEmployee()
    {
        return $this->employeeRepository->addEmployee();
    }

    public function storeEmployee(Request $request)
    {
        return $this->employeeRepository->storeEmployee($request);
    }

    public function editEmployee($id)
    {
        return $this->employeeRepository->editEmployee($id);
    }

    public function updateEmployee(Request $request)
    {
        return $this->employeeRepository->updateEmployee($request);
    }

    public function deleteEmploye($id){
        return $this->employeeRepository->deleteEmploye($id);
    }
}
