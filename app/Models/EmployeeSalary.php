<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'boucher', 'year', 'month', 'total_paid', 'comission', 'bonus', 'deduction', 'arrear', 'remarks'];

    // get Employee Details
    public function employeeDetails()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    // get employees for salary
    public function getEmployees()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
