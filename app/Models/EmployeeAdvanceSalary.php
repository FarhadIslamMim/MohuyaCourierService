<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAdvanceSalary extends Model
{
    use HasFactory;

    public function employeeDetails()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')->select('id', 'name');
    }
}
