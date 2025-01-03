<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Backend\AttendenceInterface;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    protected $attendenceRepository;

    public function __construct(AttendenceInterface $attendenceRepository)
    {
        $this->attendenceRepository = $attendenceRepository;
    }

    public function employeeAttendenceList()
    {
      return $this->attendenceRepository->employeeAttendenceList();
    }

    public function AddEmployeeAttendence(){
        return $this->attendenceRepository->AddEmployeeAttendence();
    }

    public function employeeAttendenceStore(Request $request){
        return $this->attendenceRepository->employeeAttendenceStore($request);
    }

    public function editEmployeeAttendence($date){
        return $this->attendenceRepository->editEmployeeAttendence($date);
    }

    public function viewEmployeeAttendence($date){
        return $this->attendenceRepository->viewEmployeeAttendence($date);
    }
}
