<?php 
namespace App\Interfaces\Backend;

interface AttendenceInterface{

    public function employeeAttendenceList();
    public function AddEmployeeAttendence();
    public function employeeAttendenceStore($request);
    public function editEmployeeAttendence($date);
    public function viewEmployeeAttendence($date);
}