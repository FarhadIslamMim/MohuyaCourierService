<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function agentIds()
    {
        return EmployeeAgent::where('employee_id', $this->id)->pluck('agent_id')->toArray();
    }

    public function agents()
    {
        return $this->hasMany(EmployeeAgent::class, 'employee_id');
    }

    public function agentDetails()
    {
        $agent_ids = EmployeeAgent::where('employee_id', $this->id)->pluck('agent_id');

        return Agent::whereIn('id', $agent_ids)->get();
    }

    public function areaDetails()
    {
        $area_ids = EmployeeArea::where('employee_id', $this->id)->pluck('area_id');

        return Area::whereIn('id', $area_ids)->get();
    }

    public function educations()
    {
        return $this->hasMany(EmployeeEducation::class);
    }

    public function experiences()
    {
        return $this->hasMany(EmployeeExperience::class);
    }

    public function advanceSalary()
    {
        return $this->hasMany(EmployeeAdvanceSalary::class);
    }

    public function getSalary()
    {
        return $this->hasMany(EmployeeSalary::class, 'employee_id', 'id');
    }
}
