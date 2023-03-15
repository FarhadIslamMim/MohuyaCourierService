<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupmanSalary extends Model
{
    use HasFactory;
    // get Employee Details
    public function employeeDetails()
    {
        return $this->belongsTo(Pickupman::class, 'pickupman_id', 'id');
    }
}
