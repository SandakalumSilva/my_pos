<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function advance()
    {
        return $this->belongsTo(AdvanceSalary::class, 'id', 'employee_id');
    }
}
