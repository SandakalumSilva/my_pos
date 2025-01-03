<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\SalaryInterface;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    protected $salaryRepository;

    public function __construct(SalaryInterface $salaryInterface)
    {
        $this->salaryRepository = $salaryInterface;
    }

    public function addAdvanceSalary()
    {
        return $this->salaryRepository->addAdvanceSalary();
    }

    public function advanceSalaryStore(Request $request)
    {
        return $this->salaryRepository->advanceSalaryStore($request);
    }

    public function allAdvanceSalary()
    {
        return $this->salaryRepository->allAdvanceSalary();
    }

    public function editAdvanceSalary($id)
    {
        return $this->salaryRepository->editAdvanceSalary($id);
    }

    public function advanceSalaryUpdate(Request $request)
    {
        return $this->salaryRepository->advanceSalaryUpdate($request);
    }
    public function deleteAdvanceSalary($id)
    {
        return $this->salaryRepository->deleteAdvanceSalary($id);
    }

    public function paySalary() {
        return $this->salaryRepository->paySalary();
    }

    public function payNowSalary($id){
        return  $this->salaryRepository->payNowSalary($id);
    }
    public function employeSalaryStore(Request $request){
        return $this->salaryRepository->employeSalaryStore($request);
    }

    public function monthSalary(){
        return $this->salaryRepository->monthSalary();
    }
}
