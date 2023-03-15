<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'status', 'starttime', 'endtime', 'date', 'created_at', 'updated_at'];

    // get employee data
    public function employeData()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')->select('id', 'name');
    }
}
